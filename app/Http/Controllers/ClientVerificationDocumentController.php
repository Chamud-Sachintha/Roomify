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
        $uploadedDocuments = $this->clientVerificationDocumentModel->getClientVerificationDocuments($this->user->id);

        return view('app.verifications')->with(['user' => $this->user, 'breadcrumb' => 'Account Verification', 'allDocumentTypes' => $allDocumentTypes, 'uploadedDocuments' => $uploadedDocuments]);
    }

    public function showDocumentVerificationRequestsPage() {
        $allRequests = $this->clientVerificationDocumentModel->getAllVerificationRequests();

        return view('app.admin.document-verification')->with(['user' => $this->user, 'breadcrumb' => 'Document Verification Requests', 'allRequests' => $allRequests]);
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

        $isPending = $this->clientVerificationDocumentModel->isAlreadyHavePendingDocument($clientId);
        $isAlreadyApproved = $this->clientVerificationDocumentModel->isAlreadyApprovedDocument($clientId);

        if ($isAlreadyApproved) {
            return back()->withErrors(['error' => 'Your account is already verified. No need to upload another document.']);
        }

        if ($isPending) {
            return back()->withErrors(['error' => 'You already have a pending verification document. Please wait for it to be reviewed before uploading a new one.']);
        }

        try {
            $this->clientVerificationDocumentModel->uplaodVerificationDocument($clientId,$full_name, $file, $documentType);

            return redirect()->back()->with('success', 'Verification document uploaded successfully and is pending review.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteVerificationDocument(Request $request) {
        $request->validate([
            'deleteVerificationDocumentId' => 'required|integer',
        ]);

        $documentId = $request->input('deleteVerificationDocumentId');

        try {
            $this->clientVerificationDocumentModel->deleteVerificationDocument($documentId, $this->user->id);

            return redirect()->back()->with('success', 'Verification document deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to delete the document: ' . $e->getMessage()]);
        }
    }

    public function updateVerificationRequest(Request $request) {
        $request->validate([
            'document_id' => 'required|integer',
            'status' => 'required|integer|in:0,1,2',
            'remark' => 'nullable|string|max:1000',
        ]);

        $documentId = $request->input('document_id');
        $status = $request->input('status');
        $remark = $request->input('remark', 'N/A');

        if ($status == 2 && $remark == 'N/A') {
            return back()->withErrors(['error' => 'Remark is required when rejecting a verification request.']);
        }

        try {
            $document = $this->clientVerificationDocumentModel->findOrFail($documentId);
            $document->status = $status;
            $document->remark = $remark;
            if ($status == 1) {
                $document->verified_at = now();
            }
            $document->save();

            return redirect()->back()->with('success', 'Verification request updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update the verification request: ' . $e->getMessage()]);
        }
    }
}
