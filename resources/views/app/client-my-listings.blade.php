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
            padding: 18px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            border-left: 4px solid var(--accent);
            padding-left: 10px;
            margin-bottom: 15px;
            color: var(--navy);
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

        .listing-images img {
            height: 150px;
            width: 190px;
            object-fit: cover;
            border-radius: 14px;
            margin: 7px;
            transition: 0.25s ease;
            box-shadow: 0 10px 24px rgba(15,23,42,0.12);
        }

        .listing-images img:hover {
            transform: scale(1.05);
        }

        .tag-box {
            background: rgba(255, 107, 53, 0.08);
            padding: 10px 15px;
            border-radius: 12px;
            border-left: 4px solid var(--accent);
        }

        .btn-primary,
        .btn-danger {
            border-radius: 999px;
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
                @if (isset($post))
                    <span class="badge bg-success">{{ $post->status }}</span>
                @endif
            </h1>
            <p class="text-muted">Full information about your housing listing.</p>
        </div>

        <!-- Card -->
        @if (isset($post))
            <div class="dashboard-card">

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">📄 Overview</h5>

                    <div class="d-flex gap-2">
                        <a href="{{ route('update_listing_page') }}" class="btn btn-primary px-4">
                            Update Post Information
                        </a>
                        <a href="{{ route('delete_listing_page') }}" class="btn btn-danger px-4">
                            Delete Post Information
                        </a>
                    </div>
                </div>

                <div class="card-body">

                    <!-- Images Section -->
                    <div class="detail-box">
                        <h4 class="section-title">Images</h4>
                        <div class="listing-images d-flex flex-wrap">
                            @foreach ($post->images as $img)
                                <img src="{{ asset('storage/' . $img) }}" alt="Image">
                            @endforeach
                        </div>
                    </div>

                    <!-- Basic Info -->
                    <div class="detail-box">
                        <h4 class="section-title">Basic Information</h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Location</div>
                                <div class="detail-value">{{ $post->location }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Number of Persons</div>
                                <div class="detail-value">{{ $post->number_of_persons ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Total Rent</div>
                                <div class="detail-value">Rs. {{ number_format($post->total_rent) }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Rent for You</div>
                                <div class="detail-value">Rs. {{ number_format($post->rent_for_you) }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Floor</div>
                                <div class="detail-value">{{ ucfirst($post->floor) }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Elevator Available</div>
                                <div class="detail-value">
                                    {!! $post->has_elevator 
                                        ? '<span class="badge bg-success px-3 py-2">Yes</span>' 
                                        : '<span class="badge bg-danger px-3 py-2">No</span>' !!}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Parking</div>
                                <div class="detail-value">
                                    {!! $post->has_parking 
                                        ? '<span class="badge bg-success px-3 py-2">Yes</span>' 
                                        : '<span class="badge bg-danger px-3 py-2">No</span>' !!}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Preferred Occupation</div>
                                <div class="detail-value">{{ ucfirst($post->occupation) }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Preferred Gender</div>
                                <div class="detail-value">{{ ucfirst($post->gender) }}</div>
                            </div>

                        </div>
                    </div>

                    <!-- Contact details -->

                     <div class="detail-box">
                        <h4 class="section-title">Contact Details</h4>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Contact Number</div>
                                <div class="detail-value">{{ $post->contact_number ?? 'N/A' }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="detail-label">Contact Email</div>
                                <div class="detail-value">{{ $post->contact_email ?? 'N/A' }}</div>
                            </div>

                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="detail-box">
                        <h4 class="section-title">Facilities</h4>
                        <div class="tag-box">
                            @if ($post->facilities)
                                @foreach (explode(',', $post->facilities) as $facility)
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
                            @if ($post->personal_habbits)
                                @foreach (explode(',', $post->personal_habbits) as $habit)
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
                        <p class="detail-value">{{ $post->notes ?? 'No notes added.' }}</p>
                    </div>

                </div>
            </div>
        @else
            <div class="alert alert-info">
                You have not created any listings yet. <a href="{{ route('create_listing_form') }}" class="alert-link">Create a listing now</a>.
            </div>
        @endif

    </div>
</main>

</div>

</body>
</html>
