<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showDashboardPage() {
        $user = Auth::user();
        return view('app.dashboard')->with(['user' => $user, 'breadcrumb' => 'Dashboard']);
    }

    public function showVerificationPage() {
        $user = Auth::user();
        return view('app.verifications')->with(['user' => $user, 'breadcrumb' => 'Account Verification']);
    }
}
