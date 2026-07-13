<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\ChatMessage;
use App\Models\ClientListing;
use App\Models\ClientVerificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function showDashboardPage() {
        $allListingsCount = ClientListing::query()->count();
        $myListingsCount = ClientListing::query()->where('client_id', $this->user->id)->count();
        $unreadMessagesCount = ChatMessage::query()->where('receiver_id', $this->user->id)
            ->where('is_read', 0)
            ->count();

        $verificationRequest = ClientVerificationDocument::query()->where('client_id', $this->user->id)
            ->latest('created_at')
            ->first();

        $verificationStatus = 'No request';
        $verificationLabel = 'No verification request submitted yet';
        $verificationBadge = 'secondary';

        if ($verificationRequest) {
            if ($verificationRequest->status === 0) {
                $verificationStatus = 'Pending';
                $verificationLabel = 'Verification request pending review';
                $verificationBadge = 'warning';
            } elseif ($verificationRequest->status === 1) {
                $verificationStatus = 'Approved';
                $verificationLabel = 'Your account is verified';
                $verificationBadge = 'success';
            } else {
                $verificationStatus = 'Rejected';
                $verificationLabel = 'Verification request was rejected';
                $verificationBadge = 'danger';
            }
        }

        if ($this->user->hasRole(Role::ROLE_ADMIN)) {
            $totalUsersCount = User::query()->whereHas('roles', function ($query) {
                $query->where('name', Role::ROLE_USER);
            })->count();

            $pendingVerificationsCount = ClientVerificationDocument::query()->where('status', 0)->count();
            $recentUsers = User::query()->whereHas('roles', function ($query) {
                $query->where('name', Role::ROLE_USER);
            })->latest('created_at')->take(3)->get();
            $recentListings = ClientListing::query()->latest('created_at')->take(3)->get();

            return view('app.admin.dashboard')->with([
                'user' => $this->user,
                'breadcrumb' => 'Dashboard',
                'totalListingsCount' => $allListingsCount,
                'totalUsersCount' => $totalUsersCount,
                'pendingVerificationsCount' => $pendingVerificationsCount,
                'unreadMessagesCount' => $unreadMessagesCount,
                'recentUsers' => $recentUsers,
                'recentListings' => $recentListings,
            ]);
        }

        $recentListings = ClientListing::query()->latest('created_at')->take(3)->get();
        $popularCategories = ClientListing::query()
            ->select('category_type_id', DB::raw('count(*) as total'))
            ->groupBy('category_type_id')
            ->with('categoryType')
            ->orderByDesc('total')
            ->take(3)
            ->get();

        return view('app.dashboard')->with([
            'user' => $this->user,
            'breadcrumb' => 'Dashboard',
            'allListingsCount' => $allListingsCount,
            'myListingsCount' => $myListingsCount,
            'verificationStatus' => $verificationStatus,
            'verificationLabel' => $verificationLabel,
            'verificationBadge' => $verificationBadge,
            'unreadMessagesCount' => $unreadMessagesCount,
            'recentListings' => $recentListings,
            'popularCategories' => $popularCategories,
        ]);
    }
}
