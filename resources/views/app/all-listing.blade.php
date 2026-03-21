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
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="🔍 Search listings...">
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control">
                                        <option>Category</option>
                                        <option>Apartment</option>
                                        <option>House</option>
                                        <option>Commercial</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control">
                                        <option>Location</option>
                                        <option>Colombo</option>
                                        <option>Kandy</option>
                                        <option>Galle</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <select class="form-control">
                                        <option>Price Range</option>
                                        <option>$0 - $50k</option>
                                        <option>$50k - $100k</option>
                                        <option>$100k+</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button class="btn btn-primary w-100">Filter</button>
                                </div>
                            </div>


                            <!-- LISTING CARD -->
                            <div class="detail-box">
                                <div class="row mb-5">

                                    <!-- IMAGE -->
                                    <div class="col-md-4 listing-images">
                                        <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2"
                                            class="img-fluid">
                                    </div>

                                    <!-- DETAILS -->
                                    <div class="col-md-8">

                                        <h4 class="mb-2">Luxury Apartment in Colombo</h4>

                                        <p class="text-muted mb-3">
                                            Modern fully furnished apartment located in the heart of Colombo with city
                                            views.
                                        </p>

                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <div class="detail-label">Category</div>
                                                <div class="detail-value">Apartment</div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="detail-label">Location</div>
                                                <div class="detail-value">Colombo 07</div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="detail-label">Price</div>
                                                <div class="detail-value">$120,000</div>
                                            </div>
                                        </div>

                                        <div class="tag-box mb-3">
                                            <div class="detail-label mb-2">Facilities</div>
                                            <span class="chip">3 Bedrooms</span>
                                            <span class="chip">2 Bathrooms</span>
                                            <span class="chip">Parking</span>
                                            <span class="chip">Swimming Pool</span>
                                        </div>

                                        <div class="tag-box mb-3">
                                            <div class="detail-label mb-2">Personal Habits</div>
                                            <span class="chip">3 Bedrooms</span>
                                            <span class="chip">2 Bathrooms</span>
                                            <span class="chip">Parking</span>
                                            <span class="chip">Swimming Pool</span>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge bg-success">Available</span>

                                            <div>
                                                <button class="btn btn-sm btn-outline-primary">View</button>
                                                <button class="btn btn-sm btn-outline-secondary">Edit</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>