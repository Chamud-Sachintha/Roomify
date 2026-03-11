<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfileSettings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileSettingsController extends Controller
{

    private $user;
    private $profileSettingsModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->profileSettingsModel = new ProfileSettings();
    }

    public function showProfileSettingsPage()
    {
        $settings = $this->profileSettingsModel->where('user_id', $this->user->id)->first();

        return view('app.profile-settings')->with(['settings' => $settings, 'user' => $this->user, 'breadcrumb' => 'Profile Settings']);
    }

    public function saveProfileSettings(Request $request)
    {
        $validated = $request->validate([
            'display_name'    => 'required|string|max:255',
            'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'first_name'      => 'nullable|string|max:255',
            'last_name'       => 'nullable|string|max:255',
            'phone_number'    => 'nullable|string|max:15',
            'gender'          => 'nullable|in:male,female,other',
            'date_of_birth'   => 'nullable|date',
            'occupation'      => 'nullable|string|max:255',
            'email'           => 'required|email|max:255',
            'bio'             => 'nullable|string',
        ]);

        $settings = $this->profileSettingsModel->firstOrNew(['user_id' => $this->user->id]);

        if ($request->hasFile('profile_picture')) {
            if ($settings->profile_picture) {
                Storage::disk('public')->delete($settings->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('uploads/profile_pictures', 'public');
        }

        $settings->fill($validated);
        $settings->save();

        return redirect()->route('profile_settings')->with('success', 'Profile settings updated successfully.');
    }
}
