<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function showDashboardPage() {
        if ($this->user->roles[0]['name'] == Role::ROLE_ADMIN) {
           return view('app.admin.dashboard')->with(['user' => $this->user, 'breadcrumb' => 'Dashboard']);
        }

        return view('app.dashboard')->with(['user' => $this->user, 'breadcrumb' => 'Dashboard']);
    }
}
