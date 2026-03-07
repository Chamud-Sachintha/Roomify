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
                    <h1 class="h3 font-bold">Clients Listings</h1>
                    <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.</p>
                </div>

                <div class="dashboard-grid grid-cols-12 mt-3">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Manage Client Listings</h5>
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
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Search students..." style="width: 200px;">
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
                                                    <th>Location</th>
                                                    <th>Number of Persons</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clientListingData as $clientListing)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $clientListing->id }}</td>
                                                        <td>{{ $clientListing->user->name }}</td>
                                                        <td>{{ $clientListing->location }}</td>
                                                        <td>{{ $clientListing->number_of_persons }}</td>
                                                        <td>
                                                            <a href="{{ route('view_client_listing', $clientListing->id) }}" class="btn btn-sm btn-primary">View</a>
                                                            <button class="btn btn-sm btn-danger">Delete</button>
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
                        <h5 class="modal-title" id="basicModalLabel">View Document Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-group" method="POST" action="{{ route('update_verification_request') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="fullName" class="form-label">Document Type</label>
                                    <input type="text" class="form-control" id="documentType" name="documentType"
                                        placeholder="Eg. NIC" disabled>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="verificationType" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="fullName"
                                        placeholder="Eg. NIC" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <button type="button" class="btn btn-primary w-100">View Document</button>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="document_id" name="document_id">
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
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
                        <form method="POST" action="{{ route('delete_verification_document') }}">
                            @csrf
                            <input type="hidden" id="deleteVerificationDocumentId" name="deleteVerificationDocumentId">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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

            // Modal population
            const basicModal = document.getElementById('basicModal');
            basicModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                const documentType = button.getAttribute('data-document-type');
                const fullName = button.getAttribute('data-full-name');
                const status = button.getAttribute('data-status');
                const remark = button.getAttribute('data-remark');
                const imageUrl = button.getAttribute('data-image-url');
                const documentId = button.getAttribute('data-id');

                const modalDocumentType = basicModal.querySelector('#documentType');
                const modalFullName = basicModal.querySelector('#fullName');
                const modalStatus = basicModal.querySelector('#status');
                const modalRemark = basicModal.querySelector('#remark');
                const viewDocumentButton = basicModal.querySelector('.modal-body button');

                modalDocumentType.value = documentType;
                modalFullName.value = fullName;
                document.getElementById('document_id').value = documentId;

                if (status == 1) {
                    modalStatus.value = '1';
                } else if (status == 0) {
                    modalStatus.value = '0';
                } else if (status == 2) {
                    modalStatus.value = '2';
                }

                modalRemark.value = remark;

                viewDocumentButton.onclick = function () {
                    window.open(imageUrl, '_blank');
                };
            });
    </script>

</body>

</html>