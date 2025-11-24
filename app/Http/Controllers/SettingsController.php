<?php

namespace App\Http\Controllers;

use App\Models\VerificationDocument;
use App\Services\VerificationDocumentTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    private $user;
    private $VerificationDocumentModel;
    private $verificationDocumentTypeService;

    public function __construct() {
        $this->user = Auth::user();
        $this->VerificationDocumentModel = new VerificationDocument();
        $this->verificationDocumentTypeService = new VerificationDocumentTypeService();
    }

    public function showVerificationSettingsPage()
    {
        $verificationDocumentList = $this->verificationDocumentTypeService->getAllverificationDocumentTypes();
        return view('app.admin.verification-settings')->with(['user' => $this->user, 'breadcrumb' => 'Verification-Settings', 'verificationDocumentList' => $verificationDocumentList]);
    }

    public function createVerificationDocumentType(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        try {
            $this->VerificationDocumentModel->create_document($validatedData);

            return redirect()->back()->with('success', 'Verification document type created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateVerificationDocumentType(Request $request)
    {
        $validatedData = $request->validate([
            'documentTypeId' => 'required|integer|exists:verification_documents,id',
            'editDocumentTypeName' => 'required|string|max:255',
            'editDocumentTypeStatus' => 'required|boolean',
        ]);

        try {
            $documentType = VerificationDocument::find($validatedData['documentTypeId']);
            $documentType->name = $validatedData['editDocumentTypeName'];
            $documentType->status = $validatedData['editDocumentTypeStatus'];
            $documentType->save();

            return redirect()->back()->with('success', 'Verification document type updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteVerificationDocumentType(Request $request)
    {
        $validatedData = $request->validate([
            'deleteDocumentTypeId' => 'required|integer|exists:verification_documents,id',
        ]);

        try {
            $documentType = VerificationDocument::find($validatedData['deleteDocumentTypeId']);
            $documentType->delete();

            return redirect()->back()->with('success', 'Verification document type deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
