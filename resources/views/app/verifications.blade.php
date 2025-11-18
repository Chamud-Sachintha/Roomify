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
            margin-bottom: 24px
        }

        .dashboard-card:last-child {
            margin-bottom: 0
        }

        .table-custom {
            border-radius: 8px;
            overflow: hidden
        }

        .table-custom thead {
            background: linear-gradient(135deg, #4361ee, #6366f1);
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
            background-color: #f8f9fa;
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
            color: #1f2937;
            font-weight: 600;
            margin-bottom: 2px
        }

        .student-email {
            color: #6b7280;
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
                    <h1 class="h3 font-bold">Account Verification</h1>
                    <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.</p>
                </div>

                <div class="dashboard-grid grid-cols-12">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create Verification Documents</h5>
                            <hr>
                            <form class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="verificationType" class="form-label">Select Verification
                                            Type</label>
                                        <select class="form-select" id="verificationType" required>
                                            <option value="" disabled selected>Select type</option>
                                            <option value="identity">Identity Verification</option>
                                            <option value="address">Address Verification</option>
                                            <option value="income">Income Verification</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName"
                                            placeholder="Enter full name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="documentUpload" class="form-label">Upload Supporting
                                            Document</label>
                                        <input type="file" class="form-control" id="documentUpload" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary">Generate Verification</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid grid-cols-12 mt-3">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Verification Documents</h5>
                            <hr>
                            <div class="dashboard-card">
                                <div class="dashboard-card-header py-4 px-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Student Information</h5>
                                        <div class="d-flex gap-2">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Search students..." style="width: 200px;">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="bi bi-plus me-1"></i>Add Student
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Student</th>
                                                    <th>ID Number</th>
                                                    <th>Department</th>
                                                    <th>Year</th>
                                                    <th>GPA</th>
                                                    <th>Status</th>
                                                    <th>Enrolled</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&amp;background=6366f1&amp;color=fff"
                                                                alt="Sarah Johnson" class="student-avatar me-3">
                                                            <div>
                                                                <div class="student-name">Sarah Johnson</div>
                                                                <div class="student-email">sarah.j@university.edu</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold">2025001</td>
                                                    <td>Computer Science</td>
                                                    <td>3rd Year</td>
                                                    <td><span class="badge bg-success">3.85</span></td>
                                                    <td><span class="status-badge status-active">Active</span></td>
                                                    <td>Sep 2022</td>
                                                    <td>
                                                        <button class="btn-action btn-view" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button class="btn-action btn-edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn-action btn-delete" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="https://ui-avatars.com/api/?name=Michael+Chen&amp;background=10b981&amp;color=fff"
                                                                alt="Michael Chen" class="student-avatar me-3">
                                                            <div>
                                                                <div class="student-name">Michael Chen</div>
                                                                <div class="student-email">m.chen@university.edu</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold">2025002</td>
                                                    <td>Mathematics</td>
                                                    <td>2nd Year</td>
                                                    <td><span class="badge bg-success">3.92</span></td>
                                                    <td><span class="status-badge status-active">Active</span></td>
                                                    <td>Sep 2023</td>
                                                    <td>
                                                        <button class="btn-action btn-view" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button class="btn-action btn-edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn-action btn-delete" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="https://ui-avatars.com/api/?name=Emma+Davis&amp;background=f59e0b&amp;color=fff"
                                                                alt="Emma Davis" class="student-avatar me-3">
                                                            <div>
                                                                <div class="student-name">Emma Davis</div>
                                                                <div class="student-email">emma.d@university.edu</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold">2025003</td>
                                                    <td>Physics</td>
                                                    <td>4th Year</td>
                                                    <td><span class="badge bg-warning">3.45</span></td>
                                                    <td><span class="status-badge status-active">Active</span></td>
                                                    <td>Sep 2021</td>
                                                    <td>
                                                        <button class="btn-action btn-view" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button class="btn-action btn-edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn-action btn-delete" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="https://ui-avatars.com/api/?name=James+Wilson&amp;background=ef4444&amp;color=fff"
                                                                alt="James Wilson" class="student-avatar me-3">
                                                            <div>
                                                                <div class="student-name">James Wilson</div>
                                                                <div class="student-email">james.w@university.edu</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold">2025004</td>
                                                    <td>Engineering</td>
                                                    <td>1st Year</td>
                                                    <td><span class="badge bg-info">3.65</span></td>
                                                    <td><span class="status-badge status-pending">Pending</span></td>
                                                    <td>Sep 2024</td>
                                                    <td>
                                                        <button class="btn-action btn-view" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button class="btn-action btn-edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn-action btn-delete" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr style="cursor: pointer;">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="https://ui-avatars.com/api/?name=Olivia+Brown&amp;background=8b5cf6&amp;color=fff"
                                                                alt="Olivia Brown" class="student-avatar me-3">
                                                            <div>
                                                                <div class="student-name">Olivia Brown</div>
                                                                <div class="student-email">olivia.b@university.edu</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="fw-semibold">2025005</td>
                                                    <td>Biology</td>
                                                    <td>3rd Year</td>
                                                    <td><span class="badge bg-success">3.78</span></td>
                                                    <td><span class="status-badge status-active">Active</span></td>
                                                    <td>Sep 2022</td>
                                                    <td>
                                                        <button class="btn-action btn-view" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                        <button class="btn-action btn-edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn-action btn-delete" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
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
    </div>

    <script>
        // Table interactions
        document.addEventListener('DOMContentLoaded', function () {
            // Add click handlers for action buttons
            const viewButtons = document.querySelectorAll('.btn-view');
            const editButtons = document.querySelectorAll('.btn-edit');
            const deleteButtons = document.querySelectorAll('.btn-delete');

            viewButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    alert('View functionality would open student/course details');
                });
            });

            editButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    alert('Edit functionality would open edit form');
                });
            });

            deleteButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    if (confirm('Are you sure you want to delete this record?')) {
                        alert('Delete functionality would remove the record');
                    }
                });
            });

            // Table row selection
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.style.cursor = 'pointer';
                row.addEventListener('click', function (e) {
                    // Don't select if clicking on action buttons
                    if (!e.target.closest('.btn-action')) {
                        // Remove previous selection
                        tableRows.forEach(r => r.classList.remove('table-active'));
                        // Add selection to clicked row
                        this.classList.add('table-active');
                    }
                });
            });

            // Search functionality
            const searchInput = document.querySelector('input[placeholder="Search students..."]');
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const searchTerm = this.value.toLowerCase();
                    const studentRows = document.querySelectorAll('.table-custom tbody tr');

                    studentRows.forEach(row => {
                        const studentName = row.querySelector('.student-name')?.textContent.toLowerCase();
                        const studentEmail = row.querySelector('.student-email')?.textContent.toLowerCase();

                        if (studentName?.includes(searchTerm) || studentEmail?.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>

</body>

</html>