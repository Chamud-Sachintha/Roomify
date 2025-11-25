<?php

namespace App\Http\Controllers;

use App\Models\ClientVerificationDocument;
use App\Services\VerificationDocumentTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientVerificationDocumentController extends Controller
{
    private $user;
    private $verificationDocumentTypeService;
    private $clientVerificationDocumentModel;

    public function __construct() {
        $this->user = Auth::user();
        $this->verificationDocumentTypeService = new VerificationDocumentTypeService();
        $this->clientVerificationDocumentModel = new ClientVerificationDocument();
    }

    public function showVerificationPage() {
        $allDocumentTypes = $this->verificationDocumentTypeService->getAllverificationDocumentTypes();
        return view('app.verifications')->with(['user' => $this->user, 'breadcrumb' => 'Account Verification', 'allDocumentTypes' => $allDocumentTypes]);
    }

    public function uploadNewVerificationDocument(Request $request) {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'document_type_id' => 'required|string',
            'document_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $clientId = $this->user->id;
        $documentType = $request->input('document_type_id');
        $full_name = $request->input('full_name');
        $file = $request->file('document_file');

        try {
            $this->clientVerificationDocumentModel->uplaodVerificationDocument($clientId,$full_name, $file, $documentType);

            return redirect()->back()->with('success', 'Verification document uploaded successfully and is pending review.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
