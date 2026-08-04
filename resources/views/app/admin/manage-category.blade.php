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
                    <h1 class="h3 font-bold">Category Settings</h1>
                    <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.</p>
                </div>

                <div class="dashboard-grid grid-cols-12">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create New Category Type</h5>
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
                            <form method="POST" action="{{ route('create_new_category') }}" class="row g-3 mt-2">
                                @csrf
                                <div class="col-md-6 col-sm-12">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Eg. Apartment" required>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="categoryStatus" class="form-label">Status</label>
                                    <select class="form-control" id="categoryStatus" name="categoryStatus">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="categoryDescription" class="form-label">Description</label>
                                    <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" placeholder="Optional description about this category type"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Category Type</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid grid-cols-12 mt-3">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">All Category Types</h5>
                            <hr>
                            <div class="dashboard-card">
                                <div class="dashboard-card-header py-4 px-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"></h5>
                                        <div class="d-flex gap-2">
                                            <input type="text" class="form-control form-control-sm admin-table-search"
                                                placeholder="Search categories..." style="width: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category Type Name</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->description }}</td>
                                                        <td>
                                                            @if ($category->status == 1)
                                                                <span class="badge bg-success">Active</span>
                                                            @else
                                                                <span class="badge bg-danger">Inactive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal" onclick="editCategory({{ $category }})">Edit</button>
                                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteCategory({{ $category->id }})">Delete</button>
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

        <!-- Basic Modal -->
        <div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="basicModalLabel">Edit Document Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" class="row g-3">
                            @csrf
                            <input type="hidden" id="categoryId" name="categoryId">
                            <div class="col-12">
                                <label for="editCategoryTypeName" class="form-label">Category Type Name</label>
                                <input type="text" class="form-control" id="editCategoryTypeName" name="editCategoryTypeName" required>
                            </div>
                            <div class="col-12">
                                <label for="editCategoryTypeStatus" class="form-label">Status</label>
                                <select class="form-control" id="editCategoryTypeStatus" name="editCategoryTypeStatus">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                        <p>Are you sure you want to delete this item?</p>
                        <p class="text-danger"><strong>This action cannot be undone!</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="#">
                            @csrf
                            <input type="hidden" id="deleteCategoryId" name="deleteCategoryId">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        function editCategory(data) {
            document.getElementById('categoryId').value = data.id;
            document.getElementById('editCategoryTypeName').value = data.name;
            document.getElementById('editCategoryTypeStatus').value = data.status;
        }

        function deleteCategory(id) {
            document.getElementById('deleteCategoryId').value = id;
        }

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
    </script>
</body>

</html>