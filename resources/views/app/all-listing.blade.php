<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Details - Kiaalap Dashboard</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon-9EIT7vLh.ico') }}">

    <script type="module" crossorigin src="{{ asset('dashboard/js/main-DEP3gGTG.js') }}"></script>
    <link rel="stylesheet" crossorigin href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">

    <style>
        :root {
            --bg: #fffaf5;
            --text: #1f2937;
            --muted: #6b7280;
            --card: rgba(255,255,255,0.95);
            --border: rgba(15, 23, 42, 0.08);
            --accent: #ff6b35;
            --accent-dark: #d94a1e;
            --navy: #0f172a;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.1);
        }

        body {
            background: linear-gradient(135deg, rgba(255,107,53,0.08), rgba(255,255,255,0.95));
            color: var(--text);
        }

        .dashboard-content {
            padding-top: 24px;
        }

        .dashboard-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: var(--shadow);
            padding: 20px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            border-left: 4px solid var(--accent);
            padding-left: 10px;
            margin-bottom: 15px;
        }

        .detail-box {
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(255,248,243,0.95));
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 20px;
            border: 1px solid rgba(15,23,42,0.06);
        }

        .detail-label {
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 15px;
            color: var(--text);
            background: rgba(255,255,255,0.8);
            padding: 8px 12px;
            border-radius: 10px;
        }

        .chip {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            padding: 6px 14px;
            color: #fff;
            border-radius: 999px;
            margin: 3px;
            font-size: 13px;
        }

        .listing-images {
            height: 100%;
        }

        .listing-images img {
            width: 100%;
            height: 100%;
            min-height: 220px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 10px 24px rgba(15,23,42,0.12);
        }

        .tag-box {
            background: rgba(255, 107, 53, 0.08);
            padding: 10px 15px;
            border-radius: 12px;
            border-left: 4px solid var(--accent);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            border: 0;
            border-radius: 999px;
        }

        .btn-warning {
            border-radius: 999px;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid rgba(15,23,42,0.12);
        }
    </style>
</head>

<body>

    @include('app.sidebar_menu')

    <div class="main-wrapper" id="mainWrapper">

        @include('app.header')

        <main class="dashboard-content" id="main-content">
            <div class="container-fluid">
                <!-- Page Title -->
                <div class="mb-4">
                    <h1 class="h3 font-bold">👤 All Available Listings</h1>
                    <p class="text-muted">Browse all available listings.</p>
                </div>
                <div class="dashboard-grid grid-cols-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"></h5>
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
                        </div>
                        <div class="card-body">
                            <!-- SEARCH + FILTER BAR -->
                            <form action="{{ route('filter_listings') }}" method="POST" class="mb-4">
                                @csrf
                                <div class="row mb-4">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="display_name" placeholder="🔍 Search listings...">
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control" name="category_type_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach($categoryTypeList as $categoryType)
                                            <option value="{{ $categoryType->id }}">{{ $categoryType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="location" placeholder="📍 Location">
                                </div>

                                <div class="col-md-2">
                                    <input type="number" min="0" step="1000" class="form-control" name="min_price" placeholder="Min Price">
                                </div>

                                <div class="col-md-2">
                                    <input type="number" min="0" step="1000" class="form-control" name="max_price" placeholder="Max Price">
                                </div>

                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('all_listings') }}" class="btn btn-warning w-100">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>


                            <!-- LISTING CARD -->
                            <div class="detail-box">
                                @foreach ($listings as $listing)
                                    <div class="row mb-5">

                                        <!-- IMAGE -->
                                        <div class="col-md-4 listing-images">
                                            <img src="{{ asset('/storage/' . $listing->images[0]) }}"
                                                class="img-fluid">
                                        </div>

                                        <!-- DETAILS -->
                                        <div class="col-md-8">

                                            <h4 class="mb-2">{{ $listing->display_name }}</h4>

                                            <p class="text-muted mb-3">
                                                {{ $listing->notes }}
                                            </p>

                                            <div class="row mb-4">
                                                <div class="col-md-4">
                                                    <div class="detail-label">Category</div>
                                                    <div class="detail-value">{{ $listing->categoryType->name ?? 'N/A' }}</div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="detail-label">Location</div>
                                                    <div class="detail-value">{{ $listing->location ?? 'N/A' }}</div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="detail-label">Price</div>
                                                    <div class="detail-value">LKR. {{ number_format($listing->rent_for_you ?? 0, 2) }}</div>
                                                </div>
                                            </div>

                                            <div class="tag-box mb-3">
                                                <div class="detail-label mb-2">Facilities</div>
                                                @foreach($listing->facilities as $facility)
                                                    <span class="chip">{{ $facility }}</span>
                                                @endforeach
                                            </div>

                                            <div class="tag-box mb-3">
                                                <div class="detail-label mb-2">Personal Habits</div>
                                                @foreach($listing->personal_habbits as $habit)
                                                    <span class="chip">{{ $habit }}</span>
                                                @endforeach
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge bg-success">Available</span>

                                                <div>
                                                    <a href="{{ route('view_single_listing', $listing->id) }}" class="btn btn-sm btn-primary">View</a>
                                                    @if (auth()->id() !== $listing->user->id)
                                                        <a href="{{ route('user_messages', ['receiver_id' => $listing->user->id]) }}" class="btn btn-sm btn-secondary">Contact</a>
                                                    @else
                                                        <button class="btn btn-sm btn-secondary" disabled>Contact</button>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $listings->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>