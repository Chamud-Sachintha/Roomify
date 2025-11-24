<?php

namespace App\Http\Controllers;

use App\Services\VerificationDocumentTypeService;
use Illuminate\Support\Facades\Auth;

class ClientVerificationDocumentController extends Controller
{
    private $user;
    private $verificationDocumentTypeService;

    public function __construct() {
        $this->user = Auth::user();
        $this->verificationDocumentTypeService = new VerificationDocumentTypeService();
    }

    public function showVerificationPage() {
        $allDocumentTypes = $this->verificationDocumentTypeService->getAllverificationDocumentTypes();
        return view('app.verifications')->with(['user' => $this->user, 'breadcrumb' => 'Account Verification', 'allDocumentTypes' => $allDocumentTypes]);
    }
}
