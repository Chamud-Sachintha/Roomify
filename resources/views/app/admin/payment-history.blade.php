<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kiaalap - Modern Education Management Dashboard for Universities">
    <meta name="keywords" content="education, dashboard, university, management, admin">
    <meta name="author" content="Kiaalap">

    <link rel="preconnect" href="https://images.unsplash.com" crossorigin="">
    <link rel="preconnect" href="https://ui-avatars.com" crossorigin="">
    <link rel="dns-prefetch" href="https://flagcdn.com">

    <title>Payment History - Admin</title>

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

        .status-badge {
            border-radius: 12px;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .5px;
            padding: 4px 10px;
            text-transform: uppercase
        }

        .status-pending {
            background: #fed7aa;
            color: #92400e
        }

        .status-succeeded {
            background: #d1fae5;
            color: #065f46
        }

        .status-failed {
            background: #fee2e2;
            color: #b91c1c
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

    <div class="main-wrapper" id="mainWrapper">

        @include('app.header')

        <main class="dashboard-content" id="main-content">
            <div class="container-fluid">
                <div class="mb-3">
                    <h1 class="h3 font-bold">Payment History</h1>
                    <p class="text-muted text-sm">Review all payment attempts and statuses for client listings.</p>
                </div>

                <div class="dashboard-grid grid-cols-12 mt-3">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Admin Payment History</h5>
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
                            <div class="dashboard-card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-custom mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order ID</th>
                                                <th>Client</th>
                                                <th>Listing</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($payments as $payment)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $payment->order_id }}</td>
                                                    <td>{{ optional($payment->listing->user)->name ?? 'N/A' }}</td>
                                                    <td>{{ optional($payment->listing)->display_name ?? 'N/A' }}</td>
                                                    <td>{{ number_format($payment->amount, 2) }}</td>
                                                    <td>
                                                        <span class="status-badge status-{{ $payment->status }}">
                                                            {{ ucfirst($payment->status) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $payment->created_at->format('Y-m-d H:i') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted py-4">No payment records found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
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