<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Payment Instructions</title>
    <link rel="stylesheet" href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">
</head>
<body>
    @include('app.sidebar_menu')
    <div class="main-wrapper" id="mainWrapper">
        @include('app.header')

        <main class="dashboard-content" id="main-content">
            <div class="container-fluid">
                <div class="mb-3">
                    <h1 class="h3 font-bold">Offline Payment Instructions</h1>
                    <p class="text-muted text-sm">Follow the instructions below to complete your payment offline.</p>
                </div>

                <div class="dashboard-card">
                    <div class="card-body">
                        <p><strong>Order:</strong> {{ $payment->order_id }}</p>
                        <p><strong>Amount:</strong> LKR {{ number_format($payment->amount, 2) }}</p>

                        <h5>How to pay</h5>
                        <ul>
                            <li>Pay the amount in cash or bank transfer to the account listed by the admin.</li>
                            <li>Once payment is completed, an admin will verify and mark the listing as paid.</li>
                        </ul>

                        <p class="text-muted">You will receive an email with further instructions.</p>

                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to dashboard</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
