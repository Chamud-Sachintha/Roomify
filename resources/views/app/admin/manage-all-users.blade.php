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
            --card: rgba(255,255,255,0.96);
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

        .dashboard-row {
            margin-bottom: 24px
        }

        .dashboard-grid {
            display: grid;
            gap: 24px
        }

        .grid-cols-1 {
            grid-template-columns: 1fr
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, 1fr)
        }

        @media (max-width:768px) {
            .dashboard-grid {
                gap: 16px
            }

            .grid-cols-2 {
                grid-template-columns: 1fr
            }
        }

        .dashboard-card {
            margin-bottom: 24px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 18px;
        }

        .dashboard-card:last-child {
            margin-bottom: 0
        }

        .table-custom {
            border-radius: 12px;
            overflow: hidden
        }

        .table-custom thead {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: #fff
        }

        .table-custom thead th {
            border: none;
            font-size: .875rem;
            font-weight: 600;
            letter-spacing: .5px;
            padding: 16px;
            text-transform: uppercase
        }

        .table-custom tbody tr {
            transition: all .3s ease
        }

        .table-custom tbody tr:hover {
            background-color: rgba(255,107,53,0.06);
            box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
            transform: scale(1.01)
        }

        .table-custom tbody td {
            padding: 14px 16px;
            vertical-align: middle
        }

        .student-avatar {
            border: 2px solid #e5e7eb;
            border-radius: 50%;
            height: 40px;
            object-fit: cover;
            width: 40px
        }

        .student-name {
            color: var(--navy);
            font-weight: 600;
            margin-bottom: 2px
        }

        .student-email {
            color: var(--muted);
            font-size: .875rem
        }

        .grade-badge {
            border-radius: 20px;
            display: inline-block;
            font-size: .875rem;
            font-weight: 600;
            min-width: 50px;
            padding: 6px 12px;
            text-align: center
        }

        .grade-a {
            background: #10b981;
            color: #fff
        }

        .grade-b {
            background: #3b82f6;
            color: #fff
        }

        .grade-c {
            background: #f59e0b;
            color: #fff
        }

        .grade-d {
            background: #ef4444;
            color: #fff
        }

        .grade-f {
            background: #6b7280;
            color: #fff
        }

        .status-badge {
            border-radius: 12px;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .5px;
            padding: 4px 10px;
            text-transform: uppercase
        }

        .status-active {
            background: #d1fae5;
            color: #065f46
        }

        .status-pending {
            background: #fed7aa;
            color: #92400e
        }

        .status-inactive {
            background: #e5e7eb;
            color: #374151
        }

        .status-completed {
            background: #ddd6fe;
            color: #5b21b6
        }

        .btn-action {
            align-items: center;
            border: none;
            border-radius: 6px;
            display: inline-flex;
            height: 32px;
            justify-content: center;
            margin: 0 2px;
            padding: 0;
            transition: all .3s ease;
            width: 32px
        }

        .btn-action:hover {
            transform: translateY(-2px)
        }

        .btn-view {
            background: #e0e7ff;
            color: #4338ca
        }

        .btn-view:hover {
            background: #4338ca;
            color: #fff
        }

        .btn-edit {
            background: #fef3c7;
            color: #d97706
        }

        .btn-edit:hover {
            background: #d97706;
            color: #fff
        }

        .btn-delete {
            background: #fee2e2;
            color: #dc2626
        }

        .btn-delete:hover {
            background: #dc2626;
            color: #fff
        }

        @media (max-width:768px) {
            .table-responsive {
                border: none
            }

            .table-custom {
                font-size: .875rem
            }

            .table-custom tbody td,
            .table-custom thead th {
                padding: 10px
            }
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
                    <h1 class="h3 font-bold">Manage All Users</h1>
                    <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.</p>
                </div>

                <div class="dashboard-grid grid-cols-12 mt-3">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage All Users</h5>
                            <hr>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="dashboard-card">
                                <div class="dashboard-card-header py-4 px-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"></h5>
                                        <div class="d-flex gap-2">
                                            <input type="text" class="form-control form-control-sm admin-table-search"
                                                placeholder="Search users..." style="width: 250px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client ID</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Verification Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }} </td>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td><span class="badge bg-success">{{ $user->role }}</span></td>
                                                    <td><span class="badge bg-warning text-dark">{{ $user->verification_status }}</span></td>
                                                    <td>
                                                        <a href="{{ route('view_user_details', $user->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#passwordResetModal">Reset Password</button>
                                                        @if ($user->is_verified)
                                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDisableUserId({{ $user->id }})">Disable User</button>
                                                        @else
                                                            <form method="POST" action="{{ route('enable_user') }}" class="d-inline">
                                                                @csrf
                                                                <input type="hidden" name="enableUserId" value="{{ $user->id }}">
                                                                <button type="submit" class="btn btn-sm btn-outline-success">Enable User</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('app.footer')

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">
                            <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to disable this user</p>
                        <p class="text-danger"><strong>This action cannot be undone!</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('disable_user') }}">
                            @csrf
                            <input type="hidden" id="disableUserId" name="disableUserId">
                            <button type="submit" class="btn btn-danger">Disable User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- password reset modal -->
        <div class="modal fade" id="passwordResetModal" tabindex="-1" aria-labelledby="passwordResetModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="passwordResetModalLabel">
                            <i class="bi bi-key me-2"></i>Reset Password
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('reset_user_password') }}">
                        @csrf
                        <div class="modal-body">
                            <p>Are you sure you want to reset the password for this user?</p>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">New Password</label>
                                <input type="text" class="form-control" id="newPassword" name="newPassword" placeholder="Enter a new password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <input type="hidden" id="resetUserId" name="resetUserId">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</body>

<script>
    const adminSearchInput = document.querySelector('.admin-table-search');
    if (adminSearchInput) {
        adminSearchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('.table-custom tbody tr');

            tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    function setPasswordResetUserId(userId) {
        document.getElementById('resetUserId').value = userId;
    }

    function setDisableUserId(userId) {
        document.getElementById('disableUserId').value = userId;
    }
</script>

</html>