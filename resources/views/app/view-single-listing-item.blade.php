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

        .listing-images img {
            height: 150px;
            width: 190px;
            object-fit: cover;
            border-radius: 10px;
            margin: 7px;
            transition: 0.25s ease;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .listing-images img:hover {
            transform: scale(1.05);
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
            <h1 class="h3 font-bold">
                🏠 Listing Details 
            </h1>
            <p class="text-muted">Full information about your housing listing.</p>
        </div>

        <!-- Card -->
        <div class="dashboard-card">

            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">📄 Overview</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('all_listings') }}" class="btn btn-primary px-4">
                        Back to All Listings
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="detail-box">
                    <h4 class="section-title">Images</h4>

                    <div class="row">
                        @foreach ($listing->images as $img)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset('storage/' . $img) }}" 
                                    class="img-fluid w-100" 
                                    style="height: 150px; object-fit: cover;" 
                                    alt="Image">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Basic Info -->
                <div class="detail-box">
                    <h4 class="section-title">Basic Information</h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Location</div>
                            <div class="detail-value">{{ $listing->location }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Number of Persons</div>
                            <div class="detail-value">{{ $listing->number_of_persons ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Total Rent</div>
                            <div class="detail-value">Rs. {{ number_format($listing->total_rent) }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Rent for You</div>
                            <div class="detail-value">Rs. {{ number_format($listing->rent_for_you) }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Floor</div>
                            <div class="detail-value">{{ ucfirst($listing->floor) }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Elevator Available</div>
                            <div class="detail-value">
                                {!! $listing->has_elevator 
                                    ? '<span class="badge bg-success px-3 py-2">Yes</span>' 
                                    : '<span class="badge bg-danger px-3 py-2">No</span>' !!}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Parking</div>
                            <div class="detail-value">
                                {!! $listing->has_parking 
                                    ? '<span class="badge bg-success px-3 py-2">Yes</span>' 
                                    : '<span class="badge bg-danger px-3 py-2">No</span>' !!}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Preferred Occupation</div>
                            <div class="detail-value">{{ ucfirst($listing->occupation) }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Preferred Gender</div>
                            <div class="detail-value">{{ ucfirst($listing->gender) }}</div>
                        </div>

                    </div>
                </div>

                <!-- Contact details -->

                    <div class="detail-box">
                    <h4 class="section-title">Contact Details</h4>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Contact Number</div>
                            <div class="detail-value">{{ $listing->contact_number ?? 'N/A' }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="detail-label">Contact Email</div>
                            <div class="detail-value">{{ $listing->contact_email ?? 'N/A' }}</div>
                        </div>

                    </div>
                </div>

                <!-- Facilities -->
                <div class="detail-box">
                    <h4 class="section-title">Facilities</h4>
                    <div class="tag-box">
                        @if ($listing->facilities)
                            @foreach ($listing->facilities as $facility)
                                <span class="chip">{{ $facility }}</span>
                            @endforeach
                        @else
                            <p class="text-muted mb-0">No facilities added.</p>
                        @endif
                    </div>
                </div>

                <!-- Personal Habits -->
                <div class="detail-box">
                    <h4 class="section-title">Personal Habits</h4>
                    <div class="tag-box">
                        @if ($listing->personal_habbits)
                            @foreach ($listing->personal_habbits as $habit)
                                <span class="chip">{{ $habit }}</span>
                            @endforeach
                        @else
                            <p class="text-muted mb-0">No habits added.</p>
                        @endif
                    </div>
                </div>

                <!-- Notes -->
                <div class="detail-box">
                    <h4 class="section-title">Notes</h4>
                    <p class="detail-value">{{ $listing->notes ?? 'No notes added.' }}</p>
                </div>

            </div>
        </div>
        

    </div>
</main>

</div>

</body>
</html>
