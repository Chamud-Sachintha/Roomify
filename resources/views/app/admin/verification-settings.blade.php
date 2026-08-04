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
            --card: rgba(255, 255, 255, 0.82);
            --border: rgba(15, 23, 42, 0.08);
            --accent: #ff6b35;
            --accent-dark: #d94a1e;
            --navy: #0f172a;
            --shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Instrument Sans', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(255, 107, 53, 0.18), transparent 22%),
                radial-gradient(circle at top right, rgba(56, 189, 248, 0.16), transparent 24%),
                var(--bg);
            color: var(--text);
        }

        .dashboard-content {
            padding: 24px 0 40px;
        }

        .container-fluid {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }

        .page-intro {
            margin-bottom: 22px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255, 107, 53, 0.12);
            color: var(--accent-dark);
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .page-intro h1 {
            margin: 0 0 6px;
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            letter-spacing: -0.03em;
            color: var(--navy);
        }

        .page-intro p {
            margin: 0;
            color: var(--muted);
        }

        .dashboard-grid {
            display: grid;
            gap: 24px;
        }

        .dashboard-card {
            margin-bottom: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.88), rgba(255,248,243,0.95));
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 22px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .card-header {
            background: transparent;
        }

        .card-title {
            color: var(--navy);
            font-weight: 800;
        }

        .table-custom {
            border-radius: 18px;
            overflow: hidden;
            background: white;
            border: 1px solid rgba(15,23,42,0.08);
        }

        .table-custom thead {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            color: #fff;
        }

        .table-custom thead th {
            border: none;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 14px 16px;
            text-transform: uppercase;
        }

        .table-custom tbody tr {
            transition: all 0.2s ease;
        }

        .table-custom tbody tr:hover {
            background: rgba(255, 107, 53, 0.06);
        }

        .table-custom tbody td {
            padding: 14px 16px;
            vertical-align: middle;
        }

        .student-avatar {
            border: 2px solid rgba(255, 107, 53, 0.25);
            border-radius: 50%;
            height: 40px;
            object-fit: cover;
            width: 40px;
        }

        .student-name {
            color: var(--navy);
            font-weight: 700;
            margin-bottom: 2px;
        }

        .status-badge {
            border-radius: 999px;
            font-size: 0.74rem;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 5px 10px;
            text-transform: uppercase;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fed7aa;
            color: #92400e;
        }

        .status-inactive {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-action {
            align-items: center;
            border: none;
            border-radius: 10px;
            display: inline-flex;
            height: 34px;
            justify-content: center;
            margin: 0 2px;
            padding: 0;
            transition: all 0.2s ease;
            width: 34px;
        }

        .btn-action:hover {
            transform: translateY(-1px);
        }

        .btn-edit {
            background: rgba(255, 107, 53, 0.14);
            color: var(--accent-dark);
        }

        .btn-edit:hover {
            background: var(--accent-dark);
            color: #fff;
        }

        .btn-delete {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            border: none;
            border-radius: 999px;
            box-shadow: 0 12px 24px rgba(255, 107, 53, 0.22);
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                gap: 16px;
            }

            .table-custom tbody td,
            .table-custom thead th {
                padding: 10px;
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
                <div class="page-intro">
                    <div class="eyebrow">🛡️ Verification control center</div>
                    <h1>Verification Settings</h1>
                    <p>Manage document types and keep the verification flow consistent with the rest of the Roomyfy experience.</p>
                </div>

                <div class="dashboard-grid grid-cols-12">
                    <!-- Recent Students -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create Verification Document Type</h5>
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
                            <form class="form-group" method="POST" action="{{ route('create_verification_document_type') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="fullName" class="form-label">Document Type Name</label>
                                        <input type="text" class="form-control" id="fullName" name="name"
                                            placeholder="Eg. NIC" required>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="verificationType" class="form-label">Select Status</label>
                                        <select class="form-select" id="verificationType" name="status" required>
                                            <option value="" disabled selected>Select type</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary">Create Document Type</button>
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
                            <h5 class="card-title mb-0">Verification Documents Types</h5>
                            <hr>
                            <div class="dashboard-card">
                                <div class="dashboard-card-header py-4 px-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"></h5>
                                        <div class="d-flex gap-2">
                                            <input type="text" class="form-control form-control-sm admin-table-search"
                                                placeholder="Search verification documents..." style="width: 200px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-custom mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Document Type Name</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($verificationDocumentList as $document)
                                                    <tr style="cursor: pointer;">
                                                        <td class="fw-semibold">{{ $document->id }}</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                {{-- <img src="https://ui-avatars.com/api/?name=Sarah+Johnson&amp;background=6366f1&amp;color=fff"
                                                                    alt="Sarah Johnson" class="student-avatar me-3"> --}}
                                                                <img width="48" height="48" src="https://img.icons8.com/color/48/document--v1.png" alt="document--v1"/>
                                                                <div>
                                                                    <div class="student-name">{{ $document->name }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if ($document->status == 0)
                                                                <span class="status-badge status-inactive">Inactive</span>
                                                            @else
                                                                <span class="status-badge status-active">Active</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn-action btn-edit"
                                                                    title="Edit"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#basicModal"
                                                                    data-id="{{ $document->id }}"
                                                                    data-name="{{ $document->name }}"
                                                                    data-type="{{ $document->status }}">
                                                                <i class="bi bi-pencil"></i>
                                                            </button>

                                                            <button class="btn-action btn-delete" title="Delete" 
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal"
                                                                    data-id="{{ $document->id }}"
                                                                    >
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
                        <h5 class="modal-title" id="basicModalLabel">Edit Document Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-group" method="POST" action="{{ route('update_verification_document_type') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="fullName" class="form-label">Document Type Name</label>
                                    <input type="text" class="form-control" id="editDocumentTypeName" name="editDocumentTypeName"
                                        placeholder="Eg. NIC" required>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="verificationType" class="form-label">Select Status</label>
                                    <select class="form-select" id="editDocumentTypeStatus" name="editDocumentTypeStatus" required>
                                        <option value="" disabled selected>Select type</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="documentTypeId" name="documentTypeId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update changes</button>
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
                        <form method="POST" action="{{ route('delete_verification_document_type') }}">
                            @csrf
                            <input type="hidden" id="deleteDocumentTypeId" name="deleteDocumentTypeId">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function (e) {
            if (e.target.closest('.btn-edit')) {
                let button = e.target.closest('.btn-edit');

                document.getElementById('documentTypeId').value = button.getAttribute('data-id');
                document.getElementById('editDocumentTypeName').value = button.getAttribute('data-name');
                document.getElementById('editDocumentTypeStatus').value = button.getAttribute('data-type');
            }
        });

        document.addEventListener('click', function (e) {
            if (e.target.closest('.btn-delete')) {
                let button = e.target.closest('.btn-delete');

                document.getElementById('deleteDocumentTypeId').value = button.getAttribute('data-id');
            }
        });

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