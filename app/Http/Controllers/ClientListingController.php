<?php

namespace App\Http\Controllers;

use App\Models\ClientListing;
use App\Models\ClientVerificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientListingController extends Controller
{
    private $user;
    private $ClicnetVerificationModel;
    private $ClientListingModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->ClicnetVerificationModel = new ClientVerificationDocument();
        $this->ClientListingModel = new ClientListing();
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

            // need to add payment gateway redirection here later

            DB::commit();
            return redirect()->route('client_my_listings')->with(['success', 'Listing created successfully.', 'post' => $post]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function checkDocumentVerificationStatus() {
        return $this->ClicnetVerificationModel->isAlreadyApprovedDocument($this->user->id);
    }
}
