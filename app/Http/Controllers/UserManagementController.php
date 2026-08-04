<?php

namespace App\Http\Controllers;

use App\Models\ProfileSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    private $user;
    private $profileSettingsModel;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->profileSettingsModel = new ProfileSettings();
    }

    public function showUserManagementPage() {
        $all_users = User::all();

        foreach ($all_users as $user) {
            $user->role = $user->roles->pluck('name')->first();
            $user->verification_status = $user->is_verified ? 'Verified' : 'Not Verified';
        }

        return view('app.admin.manage-all-users')->with(['users' => $all_users, 'user' => $this->user, 'breadcrumb' => 'User Management']);
    }

    public function viewUserDetails($id) {
        $managedUser = User::with('roles')->findOrFail($id);
        $settings = $this->profileSettingsModel->where('user_id', $id)->first();

        return view('app.admin.view-user')->with([
            'settings' => $settings,
            'managedUser' => $managedUser,
            'user' => $this->user,
            'breadcrumb' => 'User Details'
        ]);
    }

    public function resetUserPassword(Request $request) {
        
        $validatedData = $request->validate([
            'resetUserId' => 'required|integer|exists:users,id',
            'newPassword' => 'required|string|min:8',
        ]);

        $user = User::find($validatedData['resetUserId']);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->password = bcrypt($validatedData['newPassword']);
        $user->save();

        return redirect()->back()->with('success', 'Password reset successfully');
    }

    public function disableUser(Request $request)
    {
        $validatedData = $request->validate([
            'disableUserId' => 'required|integer|exists:users,id',
        ]);

        $user = User::find($validatedData['disableUserId']);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->is_verified = false;
        $user->save();

        return redirect()->back()->with('success', 'User disabled successfully.');
    }
}
