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
        $settings = $this->profileSettingsModel->where('user_id', $id)->first();

        return view('app.admin.view-user')->with(['settings' => $settings, 'user' => $this->user, 'breadcrumb' => 'Profile Settings']);
    }
}
