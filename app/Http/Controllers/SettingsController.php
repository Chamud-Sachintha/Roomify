<?php

namespace App\Http\Controllers;

use App\Models\VerificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    private $user;
    private $VerificationDocumentModel;

    public function __construct() {
        $this->user = Auth::user();
        $this->VerificationDocumentModel = new VerificationDocument();
    }

    public function showVerificationSettingsPage()
    {
        return view('app.admin.verification-settings')->with(['user' => $this->user, 'breadcrumb' => 'Settings']);
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
}
