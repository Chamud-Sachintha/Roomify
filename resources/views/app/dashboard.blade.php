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

        @include('app.footer')
    </div>

</body>

</html>