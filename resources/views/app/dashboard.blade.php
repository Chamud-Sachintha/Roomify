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
</head>

<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>

    <!-- Required DOM elements for dashboard.js -->
    <div class="search-backdrop" id="searchBackdrop"></div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <h5>
                    <i class="bi bi-mortarboard-fill"></i>
                    Roomify
                </h5>
                <button class="sidebar-close" id="sidebarClose">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="menu-section">
                <div class="menu-section-title">Main</div>
                <ul class="nav flex-column">
                    {{-- <li class="nav-item">
                        <a class="nav-link has-submenu " href="javascript:void(0)" data-bs-toggle="collapse"
                            data-bs-target="#dashboardSubmenu" aria-expanded="false">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                        <ul id="dashboardSubmenu" class="submenu collapse  list-unstyled">
                            <li><a class="nav-link active" href="index.html">Dashboard v.1</a></li>
                            <li><a class="nav-link " href="index-1.html">Dashboard v.2</a></li>
                            <li><a class="nav-link " href="index-2.html">Dashboard v.3</a></li>
                            <li><a class="nav-link " href="analytics.html">Analytics</a></li>
                            <li><a class="nav-link " href="widgets.html">Widgets</a></li>
                        </ul>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>All Listings</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Communication</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Support</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Contact Admin</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-section">
                <div class="menu-section-title">Account</div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Verification</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>My Listings</span>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="events.html">
                            <i class="bi bi-calendar-event"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">
        <!-- Header -->
        <nav class="navbar top-navbar">
            <div class="container-fluid d-flex align-items-center h-100">

                <!-- Breadcrumb for desktop -->
                <nav aria-label="breadcrumb" class="d-none d-lg-block ms-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>

                <!-- Logo for mobile -->
                <div class="navbar-brand d-lg-none fw-bold me-auto">Kiaalap</div>

                <!-- Spacer for desktop -->
                <div class="flex-grow-1 d-none d-lg-block"></div>

                <!-- Right Actions -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="btn btn-light btn-icon position-relative" data-bs-toggle="dropdown"
                            id="notificationsToggle">
                            <i class="bi bi-bell"></i>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="font-size: 0.6rem;">3</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="width: 320px;">
                            <li class="dropdown-header d-flex align-items-center justify-content-between">
                                <span>Notifications</span>
                                <small class="text-muted">3 new</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi bi-calendar-check text-primary"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold">New Event</div>
                                            <div class="text-muted small">Science Fair on March 15</div>
                                            <div class="text-muted small">5 minutes ago</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi bi-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold">Assignment Submitted</div>
                                            <div class="text-muted small">John submitted his project</div>
                                            <div class="text-muted small">2 hours ago</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-warning bg-opacity-10 p-2 me-3"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi bi-exclamation-triangle text-warning"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-semibold">System Alert</div>
                                            <div class="text-muted small">Database backup completed</div>
                                            <div class="text-muted small">Yesterday</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-center" href="notifications.html">
                                    <small>View all notifications</small>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- User Menu -->
                    <div class="dropdown">
                        <button class="btn btn-light d-flex align-items-center" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">
                                <img src="https://ui-avatars.com/api/?name={{ $user->name }}&background=6366f1&color=fff&size=32"
                                    alt="Sarah Johnson" class="rounded-circle" width="32" height="32">
                            </div>
                            <span class="d-none d-md-inline">{{ $user->name }}</span>
                            <i class="bi bi-chevron-down ms-1"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-question-circle me-2"></i>Help
                                    Center</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
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
                            <div class="stats-card-value">$5,000</div>
                            <span class="stats-card-change positive">+20%</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-success" style="width: 20%"></div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-card-label">My Listings</div>
                            <div class="stats-card-value">$3,000</div>
                            <span class="stats-card-change positive">+30%</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-danger" style="width: 30%"></div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-card-label">Verification Status</div>
                            <div class="stats-card-value">$2,000</div>
                            <span class="stats-card-change positive">+60%</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-info" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="stats-card">
                            <div class="stats-card-label">Unread Messages</div>
                            <div class="stats-card-value">$3,500</div>
                            <span class="stats-card-change positive">+80%</span>
                            <div class="progress-custom">
                                <div class="progress-bar-custom bg-warning" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-grid grid-cols-2">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                            <h5 class="dashboard-card-title mb-0">Recent Students</h5>
                            <a href="all-students.html" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <img src="https://ui-avatars.com/api/?name=John+Smith&background=0d6efd&color=fff"
                                        alt="John Smith" class="rounded-circle me-3" width="40" height="40"
                                        loading="lazy">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">John Smith</h6>
                                        <small class="text-muted">Computer Science - Freshman</small>
                                        <div class="small text-muted">Enrolled 2 hours ago</div>
                                    </div>
                                    <span class="badge bg-success">Active</span>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <img src="https://ui-avatars.com/api/?name=Emily+Davis&background=198754&color=fff"
                                        alt="Emily Davis" class="rounded-circle me-3" width="40" height="40"
                                        loading="lazy">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Emily Davis</h6>
                                        <small class="text-muted">Biology - Sophomore</small>
                                        <div class="small text-muted">Enrolled 1 day ago</div>
                                    </div>
                                    <span class="badge bg-success">Active</span>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <img src="https://ui-avatars.com/api/?name=Michael+Brown&background=dc3545&color=fff"
                                        alt="Michael Brown" class="rounded-circle me-3" width="40" height="40"
                                        loading="lazy">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Michael Brown</h6>
                                        <small class="text-muted">Mathematics - Junior</small>
                                        <div class="small text-muted">Enrolled 3 days ago</div>
                                    </div>
                                    <span class="badge bg-warning">Pending</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Courses -->
                    <div class="dashboard-card">
                        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
                            <h5 class="dashboard-card-title mb-0">Popular Courses</h5>
                            <a href="all-courses.html" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-code-slash" style="color: #0d6efd;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Advanced Programming</h6>
                                        <small class="text-muted">Prof. Sarah Johnson</small>
                                        <div class="small text-muted">45 enrolled students</div>
                                    </div>
                                    <span class="badge bg-success">85% Full</span>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-calculator" style="color: #198754;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Calculus II</h6>
                                        <small class="text-muted">Prof. Michael Chen</small>
                                        <div class="small text-muted">38 enrolled students</div>
                                    </div>
                                    <span class="badge bg-success">76% Full</span>
                                </div>
                                <div class="list-group-item d-flex align-items-center px-0 py-3">
                                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center me-3"
                                        style="width: 40px; height: 40px;">
                                        <i class="bi bi-microscope" style="color: #0dcaf0;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Biology Lab</h6>
                                        <small class="text-muted">Prof. Lisa Thompson</small>
                                        <div class="small text-muted">28 enrolled students</div>
                                    </div>
                                    <span class="badge bg-warning text-dark">56% Full</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="dashboard-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0">� 2025 Kiaalap. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">Built with <i class="bi bi-heart-fill text-danger"></i> for education</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Load JavaScript -->



</body>

</html>