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
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            border-left: 4px solid #0d6efd;
            padding-left: 10px;
            margin-bottom: 15px;
        }

        .detail-box {
            background: #fff;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 20px;
            border: 1px solid #e6e6e6;
        }

        .detail-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 15px;
            color: #555;
            background: #f8f9fc;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .chip {
            display: inline-block;
            background: #0d6efd;
            padding: 6px 14px;
            color: #fff;
            border-radius: 20px;
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
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .tag-box {
            background: #f1f5ff;
            padding: 10px 15px;
            border-radius: 10px;
            border-left: 4px solid #0d6efd;
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
                                    <select class="form-control" name="price_range">
                                        <option>Price Range</option>
                                        <option>$0 - $50k</option>
                                        <option>$50k - $100k</option>
                                        <option>$100k+</option>
                                    </select>
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
                                                    <button class="btn btn-sm btn-secondary">Contact</button>
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