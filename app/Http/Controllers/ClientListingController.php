<?php

namespace App\Http\Controllers;

use App\Models\AppPayments;
use App\Models\ClientListing;
use App\Models\ClientVerificationDocument;
use App\Services\CategoryTypeService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientListingController extends Controller
{
    private $user;
    private $ClicnetVerificationModel;
    private $ClientListingModel;
    private $AppPaymentModel;
    private $categoryTypeService;

    public function __construct()
    {
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

            $paymentDetails = [
                "listing_id"    =>  $post->id,
                "order_id"      =>  uniqid("ORD-"),
                "status"    =>  "pending",
                "amount"    => 1000
            ];

            $payment = $this->AppPaymentModel->createPaymentDetails($paymentDetails);

            DB::commit();

            $stripe = new PaymentService();
            $checkoutUrl = $stripe->createCheckout($payment, 1000);

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
        $listings = $this->ClientListingModel->getAllListings();

        $facilities = explode(',', $listings->pluck('facilities')->first() ?? '');
        $personal_habits = explode(',', $listings->pluck('personal_habbits')->first() ?? '');
        $images = explode(',', $listings->pluck('images')->first() ?? '');

        if (isset($listings[0])) {
            $listings[0]->facilities = $facilities;
        }

        if (isset($listings[0])) {
            $listings[0]->personal_habbits = $personal_habits;
        }

        if (isset($listings[0])) {
            $listings[0]->images = $images;
        }

        return view('app.all-listing')->with([
            'user' => $this->user,
            'breadcrumb' => 'All Listings',
            'listings' => $listings,
        ]);
    }

    public function showsSingleListingItem($id) {
        $listing = $this->ClientListingModel->getListingById($id);

        if (!$listing) {
            return redirect()->route('all_listings')->with('error', 'Listing not found.');
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

    private function checkDocumentVerificationStatus() {
        return $this->ClicnetVerificationModel->isAlreadyApprovedDocument($this->user->id);
    }
}
