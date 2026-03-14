<?php

namespace App\Http\Controllers;

use App\Models\AppPayments;
use App\Models\ClientListing;
use App\Models\ClientVerificationDocument;
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

    public function __construct()
    {
        $this->user = Auth::user();
        $this->ClicnetVerificationModel = new ClientVerificationDocument();
        $this->ClientListingModel = new ClientListing();
        $this->AppPaymentModel = new AppPayments();
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

        return view('app.create-listing-form')->with(['user' => $this->user, 'breadcrumb' => 'Create New Listing']);
    }

    public function createNewListing(Request $request) {
        $validated = $request->validate([
            'location'           => 'required|string',
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

        foreach ($listings as $listing) {
            if ($listing->images) {
                $listing->images = explode(',', $listing->images);
            }
        }

        return view('app.all-listing')->with([
            'user' => $this->user,
            'breadcrumb' => 'All Listings',
            'listings' => $listings,
        ]);
    }

    private function checkDocumentVerificationStatus() {
        return $this->ClicnetVerificationModel->isAlreadyApprovedDocument($this->user->id);
    }
}
