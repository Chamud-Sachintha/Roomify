<?php

namespace App\Http\Controllers;

use App\Models\ClientListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageClientListingController extends Controller
{
    private $user;
    private $clientListingModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->clientListingModel = new ClientListing();
    }

    public function showManageClientListingsPage() {

        $clientListingData = $this->clientListingModel->with('user')->get();

        return view('app.admin.manage-client-listings')->with(
            ['breadcrumb' => 'Manage Client Listings', 'user' => $this->user, 'clientListingData' => $clientListingData]);
    }

    public function viewClientListingDetails($id) {
        $clientListingData = $this->clientListingModel->with('user')->findOrFail($id);

        if ($clientListingData && isset($clientListingData->images)) {
            $clientListingData->images = explode(',', $clientListingData->images);
        }

        return view('app.admin.admin-view-listing')->with(
            ['breadcrumb' => 'View Client Listing Details', 'user' => $this->user, 'clientListingData' => $clientListingData]);
    }

    public function deleteClientListing($id) {
        $clientListingData = $this->clientListingModel->findOrFail($id);

        if ($clientListingData) {
            $clientListingData->delete();
            return redirect()->route('manage_client_listings')->with('success', 'Client listing deleted successfully.');
        }

        return redirect()->route('manage_client_listings')->with('error', 'Client listing not found.');
    }

    public function updateListingStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:client_listings,id',
            'status' => 'required|in:pending,approved,rejected',
            'remark' => 'nullable|string|max:255',
        ]);

        $listing = $this->clientListingModel->getListingById($validated['id']);

        if (!$listing) {
            return redirect()->route('view_client_listing')->with('error', 'Listing status updated Not successfully.');
        }

        $listing->status = $validated['status'];
        $listing->remark = $validated['remark'] ?? null;
        $listing->save();

        return redirect()->route('view_client_listing', ['id' => $listing->id])->with('success', 'Listing status updated successfully.');
    }
}
