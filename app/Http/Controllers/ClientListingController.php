<?php

namespace App\Http\Controllers;

use App\Mail\ClientListingNotificationMail;
use App\Models\AppPayments;
use App\Models\ClientListing;
use App\Models\ClientVerificationDocument;
use App\Models\Settings;
use App\Services\CategoryTypeService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ClientListingController extends Controller
{
    private $user;
    private $ClicnetVerificationModel;
    private $ClientListingModel;
    private $AppPaymentModel;
    private $categoryTypeService;

    public function __construct()
    {
        Paginator::useBootstrap();

        $this->user = Auth::user();
        $this->ClicnetVerificationModel = new ClientVerificationDocument();
        $this->ClientListingModel = new ClientListing();
        $this->AppPaymentModel = new AppPayments();
        $this->categoryTypeService = new CategoryTypeService();
    }

    public function showCreateListingPage() {

        if (!$this->checkDocumentVerificationStatus()) {
            return redirect()->route('dashboard')->with('error', 'You need to verify your documents before creating a listing.');
        }

        $post = $this->ClientListingModel->getListingByUserId($this->user->id);

        if ($post && isset($post->images)) {
            $post->images = explode(',', $post->images);
        }

        return view('app.client-my-listings')->with([
            'user' => $this->user,
            'breadcrumb' => 'My Listings',
            'post' => $post,
        ]);
    }

    public function showCreateListingFormPage() {
        
        if (!$this->checkDocumentVerificationStatus()) {
            return redirect()->route('dashboard')->with('error', 'You need to verify your documents before creating a listing.');
        }

        $isAlreadyHaveListing = $this->ClientListingModel->getListingByUserId($this->user->id);
        
        if ($isAlreadyHaveListing) {
            return redirect()->route('client_my_listings')->with('info', 'You have already created a listing.');
        }

        $categories = $this->categoryTypeService->getAllCategoryTypes();

        return view('app.create-listing-form')->with([
            'user' => $this->user,
            'breadcrumb' => 'Create New Listing',
            'categories' => $categories
        ]);
    }

    public function createNewListing(Request $request) {
        $validated = $request->validate([
            'location'           => 'required|string',
            'display_name'       => 'nullable|string|max:255',
            'category_type_id'   => 'nullable|exists:categories,id',
            'number_of_persons'  => 'nullable|integer|min:1',
            'total_rent'         => 'nullable|numeric|min:0',
            'rent_for_you'       => 'nullable|numeric|min:0',
            'floor'              => 'nullable|in:ground,first,second,other',
            'has_elevator'       => 'required|boolean',
            'has_parking'        => 'required|boolean',
            'ocupation'          => 'nullable|in:employed,student,unemployed,retired',
            'gender'             => 'nullable|in:male,female,other',
            'facilities'         => 'nullable|string',
            'personal_habbits'   => 'nullable|string',
            'contact_number'     => 'nullable|string|max:10',
            'contact_email'      => 'nullable|email|max:255',
            'notes'              => 'nullable|string',
            'images'             => 'nullable|array|max:3',
            'images.*'           => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            // Image upload
            $imagePaths = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    $path = $img->store('uploads/posts', 'public');
                    $imagePaths[] = $path;
                }
            }

            $post = $this->ClientListingModel->createListing($this->user->id, $validated, $imagePaths);

            $postingFee = (float) Settings::getValue('ad_posting_fee', 1000);
            $postingDiscount = (float) Settings::getValue('ad_posting_discount', 0);
            $finalAmount = max(0, $postingFee - $postingDiscount);

            $paymentDetails = [
                "listing_id"    =>  $post->id,
                "order_id"      =>  uniqid("ORD-"),
                "status"    =>  "pending",
                "amount"    =>  $finalAmount
            ];

            $payment = $this->AppPaymentModel->createPaymentDetails($paymentDetails);

            DB::commit();

            Mail::to($this->user->email)->send(new ClientListingNotificationMail($post, 'created'));

            $stripe = new PaymentService();
            $checkoutUrl = $stripe->createCheckout($payment);

            return redirect($checkoutUrl);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showUpdateListingPage()
    {
        if (!$this->checkDocumentVerificationStatus()) {
            return redirect()->route('dashboard')->with('error', 'You need to verify your documents before updating a listing.');
        }

        $post = $this->ClientListingModel->getListingByUserId($this->user->id);

        if ($post && isset($post->images)) {
            $post->images = explode(',', $post->images);
        }

        return view('app.update-my-listing-page')->with([
            'user' => $this->user,
            'breadcrumb' => 'Update Listing',
            'post' => $post,
        ]);
    }

    public function updateListing(Request $request)
    {
        $validated = $request->validate([
            'location'           => 'required|string',
            'number_of_persons'  => 'nullable|integer|min:1',
            'total_rent'         => 'nullable|numeric|min:0',
            'rent_for_you'       => 'nullable|numeric|min:0',
            'facilities'         => 'nullable|string',
            'personal_habbits'   => 'nullable|string',
            'notes'              => 'nullable|string',
            'images'             => 'nullable|array|max:3',
            'images.*'           => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $post = $this->ClientListingModel->getListingByUserId($this->user->id);

            if (!$post) {
                return redirect()->route('client_my_listings')->with('error', 'Listing not found.');
            }

            // Image upload
            $imagePaths = $post->images ? explode(',', $post->images) : [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $img) {
                    $path = $img->store('uploads/posts', 'public');
                    $imagePaths[] = $path;
                }
            }

            $post->update([
                'location'          => $validated['location'],
                'number_of_persons' => $validated['number_of_persons'] ?? null,
                'total_rent'        => $validated['total_rent'] ?? null,
                'rent_for_you'      => $validated['rent_for_you'] ?? null,
                'facilities'        => $validated['facilities'] ?? '',
                'personal_habbits'  => $validated['personal_habbits'] ?? '',
                'notes'             => $validated['notes'] ?? null,
                'images'            => implode(',', $imagePaths),
            ]);

            DB::commit();

            return redirect()->route('client_my_listings')->with('success', 'Listing updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteListing(Request $request)
    {
        $post = $this->ClientListingModel->getListingByUserId($this->user->id);

        if (!$post) {
            return redirect()->route('client_my_listings')->with('error', 'Listing not found.');
        }

        $post->delete();

        return redirect()->route('client_my_listings')->with('success', 'Listing deleted successfully.');
    }

    public function showAllListings() {
        $listings = $this->ClientListingModel->getApprovedListingsPaginated(10);
        $listings = $this->prepareListings($listings);

        return view('app.all-listing')->with([
            'user' => $this->user,
            'breadcrumb' => 'All Listings',
            'listings' => $listings,
            'categoryTypeList' => $this->categoryTypeService->getAllCategoryTypes()
        ]);
    }

    public function showsSingleListingItem($id) {
        $listing = $this->ClientListingModel->getApprovedListingById($id);

        if (!$listing) {
            return redirect()->route('all_listings')->with('error', 'Listing not found or not yet approved.');
        }

        $facilities = explode(',', $listing->facilities);
        $personal_habits = explode(',', $listing->personal_habbits);
        $images = explode(',', $listing->images);

        $listing->facilities = $facilities;
        $listing->personal_habbits = $personal_habits;
        $listing->images = $images;

        return view('app.view-single-listing-item')->with([
            'user' => $this->user,
            'breadcrumb' => 'Listing Details',
            'listing' => $listing,
        ]);
    }

    public function doFilterClientListingItems(Request $request) {
        $validated = $request->validate([
            'display_name' => 'nullable|string|max:255',
            'location' => 'nullable|string',
            'category_type_id' => 'nullable|exists:categories,id',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'gender' => 'nullable|in:male,female,other',
            'personal_habits' => 'nullable|string',
        ]);

        $filter_data['display_name'] = $validated['display_name'] ?? null;
        $filter_data['location'] = $validated['location'] ?? null;
        $filter_data['category_type_id'] = $validated['category_type_id'] ?? null;
        $filter_data['min_price'] = $validated['min_price'] ?? null;
        $filter_data['max_price'] = $validated['max_price'] ?? null;
        $filter_data['gender'] = $validated['gender'] ?? null;
        $filter_data['personal_habits'] = $validated['personal_habits'] ?? null;

        $listings = $this->ClientListingModel->filterListings($filter_data, 10);

        $listings = $this->prepareListings($listings);

        return view('app.all-listing')->with([
            'user' => $this->user,
            'breadcrumb' => 'All Listings',
            'listings' => $listings,
            'categoryTypeList' => $this->categoryTypeService->getAllCategoryTypes()
        ]);
    }

    private function prepareListings($listings)
    {
        foreach ($listings as $listing) {
            $listing->facilities = !empty($listing->facilities)
                ? explode(',', $listing->facilities)
                : [];

            $listing->personal_habbits = !empty($listing->personal_habbits)
                ? explode(',', $listing->personal_habbits)
                : [];

            $listing->images = !empty($listing->images)
                ? explode(',', $listing->images)
                : [];
        }

        return $listings;
    }

    private function checkDocumentVerificationStatus() {
        return $this->ClicnetVerificationModel->isAlreadyApprovedDocument($this->user->id);
    }
}
