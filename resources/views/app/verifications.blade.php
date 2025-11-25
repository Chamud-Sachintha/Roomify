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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="alert alert-info" role="alert">
                                A simple secondary alert—check it out!
                            </div>
                            <form class="form-group" method="POST" action="{{ route('upload_verification_document') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="verificationType" class="form-label">Select Verification
                                            Type</label>
                                        <select class="form-select" id="verificationType" name="document_type_id" required>
                                            <option value="" disabled selected>Select type</option>
                                            @foreach ($allDocumentTypes as $documentType)
                                                <option value="{{ $documentType->id }}">{{ $documentType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="fullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="fullName" name="full_name"
                                            placeholder="Enter full name" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="documentUpload" class="form-label">Upload Supporting
                                            Document</label>
                                        <input type="file" class="form-control" id="documentUpload" name="document_file" required>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Document Type</th>
                                                    <th>Full Name</th>
                                                    <th>Status</th>
                                                    <th>Remark</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($uploadedDocuments as $document)
                                                    <tr style="cursor: pointer;">
                                                        <td>
                                                            {{ $document->id }}
                                                        </td>
                                                        <td class="fw-semibold">{{ $document->documentType->name }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="https://ui-avatars.com/api/?name={{ $document->full_name }}&amp;background=6366f1&amp;color=fff"
                                                                    alt="Sarah Johnson" class="student-avatar me-3">
                                                                <div>
                                                                    <div class="student-name">{{ $document->full_name }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($document->status == 1)
                                                                <span class="status-badge status-active">Approved</span>
                                                            @elseif ($document->status == 0)
                                                                <span class="status-badge status-pending">Pending</span>
                                                            @elseif ($document->status == 2)
                                                                <span class="status-badge status-inactive">Rejected</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $document->remark }}</td>
                                                        <td>
                                                            <button class="btn-action btn-view" title="View"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#basicModal"
                                                                    data-document-type="{{ $document->documentType->name }}"
                                                                    data-full-name="{{ $document->full_name }}"
                                                                    data-status="{{ $document->status }}"
                                                                    data-remark="{{ $document->remark }}"
                                                                    data-image-url="{{ Storage::url($document->document_path) }}"
                                                                    >
                                                                <i class="bi bi-eye"></i>
                                                            </button>
                                                            <button class="btn-action btn-delete" title="Delete" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal"
                                                                    data-id="{{ $document->id }}">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
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
                        <form class="form-group" method="POST" action="">
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
                                    <input type="text" class="form-control" id="status" name="status"
                                        placeholder="Eg. Approved / Pending" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark" rows="3" disabled></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <button type="button" class="btn btn-primary w-100">View Document</button>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
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

                const modalDocumentType = basicModal.querySelector('#documentType');
                const modalFullName = basicModal.querySelector('#fullName');
                const modalStatus = basicModal.querySelector('#status');
                const modalRemark = basicModal.querySelector('#remark');
                const viewDocumentButton = basicModal.querySelector('.modal-body button');

                modalDocumentType.value = documentType;
                modalFullName.value = fullName;
    
                if (status == 1) {
                    modalStatus.value = 'Approved';
                } else if (status == 0) {
                    modalStatus.value = 'Pending';
                } else if (status == 2) {
                    modalStatus.value = 'Rejected';
                } else {
                    modalStatus.value = 'Unknown';
                }

                modalRemark.value = remark;

                viewDocumentButton.onclick = function () {
                    window.open(imageUrl, '_blank');
                };
            });

            // Delete modal population
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const documentId = button.getAttribute('data-id');

                const deleteInput = deleteModal.querySelector('#deleteVerificationDocumentId');
                deleteInput.value = documentId;
            });
    </script>

</body>

</html>