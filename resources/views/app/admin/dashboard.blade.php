<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kiaalap - Modern Education Management Dashboard for Universities">
    <meta name="keywords" content="education, dashboard, university, management, admin">
    <meta name="author" content="Kiaalap">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin="">
    <link rel="preconnect" href="https://ui-avatars.com" crossorigin="">
    <link rel="dns-prefetch" href="https://flagcdn.com">

    <title>Dashboard - Kiaalap Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon-9EIT7vLh.ico') }}">

    <script type="module" crossorigin="" src="{{ asset('dashboard/js/main-DEP3gGTG.js') }}"></script>
    <link rel="stylesheet" crossorigin="" href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">

    <style>
        :root {
            --bg: #fffaf5;
            --text: #1f2937;
            --muted: #6b7280;
            --card: rgba(255,255,255,0.95);
            --border: rgba(15, 23, 42, 0.08);
            --accent: #ff6b35;
            --accent-dark: #d94a1e;
            --navy: #0f172a;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.1);
        }

        body {
            background: linear-gradient(135deg, rgba(255,107,53,0.08), rgba(255,255,255,0.95));
            color: var(--text);
        }

        .main-wrapper {
            background: transparent;
        }

        .dashboard-content {
            padding-top: 24px;
        }

        .container-fluid {
            padding-left: 24px;
            padding-right: 24px;
        }

        .stats-card,
        .dashboard-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: var(--shadow);
        }

        .stats-card {
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            inset: 0 auto auto 0;
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, rgba(255,107,53,0.16), transparent);
            border-radius: 0 0 100px 0;
        }

        .stats-card-label {
            color: var(--muted);
            font-weight: 600;
            font-size: 0.92rem;
        }

        .stats-card-value {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--navy);
            margin: 6px 0;
        }

        .stats-card-change {
            font-weight: 600;
            color: var(--accent-dark);
        }

        .dashboard-card {
            padding: 18px;
        }

        .dashboard-card-header {
            border-bottom: 1px solid rgba(15,23,42,0.06);
            padding-bottom: 12px;
            margin-bottom: 12px;
        }

        .dashboard-card-title {
            color: var(--navy);
            font-weight: 700;
        }

        .btn-outline-primary {
            border-color: rgba(255,107,53,0.25);
            color: var(--accent-dark);
            border-radius: 999px;
        }

        .btn-outline-primary:hover {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .list-group-item {
            border-color: rgba(15,23,42,0.06);
        }

        .badge {
            border-radius: 999px;
        }
    </style>
</head>

<body>

    @include('app.sidebar_menu')

    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        @include('app.header')
        
        <!-- Main Content -->
        <main class="dashboard-content" id="main-content">
            <div class="container-fluid">
                <!-- Page Header -->
                <div class="mb-3">
                    <h1 class="h3 font-bold">Dashboard Overview</h1>
                    <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.</p>
                </div>

                <!-- Stats Cards Row -->
                <div class="dashboard-row">
                    <div class="dashboard-grid grid-cols-4">
                        <div class="stats-card">
                            <div class="stats-card-label">All Listings</div>
                            <div class="stats-card-value">{{ $totalListingsCount ?? 0 }}</div>
                            <span class="stats-card-change positive">{{ $totalListingsCount > 0 ? '+'.round(min(100, ($totalListingsCount / max(1, $totalListingsCount)) * 100)).'%' : '0%' }}</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-success" style="width: 100%"></div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-card-label">Total Users</div>
                            <div class="stats-card-value">{{ $totalUsersCount ?? 0 }}</div>
                            <span class="stats-card-change positive">{{ $totalUsersCount > 0 ? '+'.round(min(100, ($totalUsersCount / max(1, $totalUsersCount)) * 100)).'%' : '0%' }}</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-danger" style="width: {{ min(100, ($totalUsersCount ?? 0) * 10) }}%"></div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-card-label">Pending Verifications</div>
                            <div class="stats-card-value">{{ $pendingVerificationsCount ?? 0 }}</div>
                            <span class="stats-card-change positive">{{ $pendingVerificationsCount > 0 ? '+'.round(min(100, ($pendingVerificationsCount / max(1, $pendingVerificationsCount)) * 100)).'%' : '0%' }}</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-info" style="width: {{ min(100, ($pendingVerificationsCount ?? 0) * 10) }}%"></div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-card-label">Unread Messages</div>
                            <div class="stats-card-value">{{ $unreadMessagesCount ?? 0 }}</div>
                            <span class="stats-card-change positive">{{ $unreadMessagesCount > 0 ? '+'.round(min(100, ($unreadMessagesCount / max(1, $unreadMessagesCount)) * 100)).'%' : '0%' }}</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-warning" style="width: {{ min(100, ($unreadMessagesCount ?? 0) * 10) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-grid grid-cols-2">
                    <!-- Recent Clients -->
                    <div class="dashboard-card">
                        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                            <h5 class="dashboard-card-title mb-0">Recent Clients</h5>
                            <a href="{{ route('manage_all_users') }}" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="list-group list-group-flush">
                                @forelse($recentUsers as $client)
                                    <div class="list-group-item d-flex align-items-center px-0 py-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($client->name) }}&background=0d6efd&color=fff"
                                            alt="{{ $client->name }}" class="rounded-circle me-3" width="40" height="40"
                                            loading="lazy">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{ $client->name }}</h6>
                                            <small class="text-muted">{{ $client->email }}</small>
                                            <div class="small text-muted">Joined {{ $client->created_at->diffForHumans() }}</div>
                                        </div>
                                        <span class="badge bg-success">Client</span>
                                    </div>
                                @empty
                                    <div class="list-group-item px-0 py-3 text-muted">No recent clients found.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Latest Listings -->
                    <div class="dashboard-card">
                        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                            <h5 class="dashboard-card-title mb-0">Latest Listings</h5>
                            <a href="{{ route('manage_client_listings') }}" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="list-group list-group-flush">
                                @forelse($recentListings as $listing)
                                    <div class="list-group-item px-0 py-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $listing->display_name }}</h6>
                                                <small class="text-muted">{{ $listing->location }} · {{ $listing->number_of_persons }} persons</small>
                                                <div class="small text-muted">Posted {{ $listing->created_at->diffForHumans() }}</div>
                                            </div>
                                            <span class="badge bg-{{ $listing->status === 'approved' ? 'success' : ($listing->status === 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($listing->status) }}</span>
                                        </div>
                                        <div class="small text-muted">Rent: {{ number_format($listing->total_rent, 0) }} / month</div>
                                    </div>
                                @empty
                                    <div class="list-group-item px-0 py-3 text-muted">No recent listings available.</div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('app.footer')
    </div>

</body>

</html>