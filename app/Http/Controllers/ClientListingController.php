<?php

namespace App\Http\Controllers;

use App\Models\ClientVerificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientListingController extends Controller
{
    private $user;
    private $ClicnetVerificationModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->ClicnetVerificationModel = new ClientVerificationDocument();
    }

    public function showCreateListingPage() {

        $isDocumentVerified = $this->ClicnetVerificationModel->isAlreadyApprovedDocument($this->user->id);

        if (!$isDocumentVerified) {
            return redirect()->route('dashboard')->with('error', 'You need to verify your documents before creating a listing.');
        }

        return view('app.client-my-listings')->with(['user' => $this->user, 'breadcrumb' => 'My Listings']);
    }
}
