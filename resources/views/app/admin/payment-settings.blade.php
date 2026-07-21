<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Settings - Roomyfy</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon-9EIT7vLh.ico') }}">
    <script type="module" crossorigin="" src="{{ asset('dashboard/js/main-DEP3gGTG.js') }}"></script>
    <link rel="stylesheet" crossorigin="" href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">
</head>
<body>
    @include('app.sidebar_menu')

    <div class="main-wrapper" id="mainWrapper">
        @include('app.header')

        <main class="dashboard-content" id="main-content">
            <div class="container-fluid">
                <div class="mb-3">
                    <h1 class="h3 font-bold">Payment Settings</h1>
                    <p class="text-muted text-sm">Manage the amount charged for ad posting payments.</p>
                </div>

                <div class="dashboard-grid grid-cols-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Ad Posting Fee</h5>
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

                            <form class="form-group" method="POST" action="{{ route('save_payment_settings') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 mb-3">
                                        <label for="adPostingFee" class="form-label">Fee Amount (LKR)</label>
                                        <input type="number" class="form-control" id="adPostingFee" name="ad_posting_fee" value="{{ $adPostingFee ?? 1000 }}" min="0" step="0.01" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary">Save Payment Settings</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('app.footer')
    </div>
</body>
</html>
