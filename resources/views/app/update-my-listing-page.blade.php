<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Listing - Roomyfy</title>

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
            <h1 class="h3 font-bold">✏️ Update Listing</h1>
            <p class="text-muted">Modify your listing details below.</p>
        </div>

        <!-- Update Form -->
        <form action="{{ route('update_client_listing') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $post->location) }}" required>
            </div>

            <!-- Number of Persons -->
            <div class="mb-3">
                <label for="number_of_persons" class="form-label">Number of Persons</label>
                <input type="number" class="form-control" id="number_of_persons" name="number_of_persons" value="{{ old('number_of_persons', $post->number_of_persons) }}">
            </div>

            <!-- Category Type -->
            <div class="mb-3">
                <label for="category_type_id" class="form-label">Category Type</label>
                <select name="category_type_id" id="category_type_id" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ ($post->category_type_id == $cat->id) ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Total Rent -->
            <div class="mb-3">
                <label for="total_rent" class="form-label">Total Rent</label>
                <input type="number" class="form-control" id="total_rent" name="total_rent" value="{{ old('total_rent', $post->total_rent) }}">
            </div>

            <!-- Rent for You -->
            <div class="mb-3">
                <label for="rent_for_you" class="form-label">Rent for You</label>
                <input type="number" class="form-control" id="rent_for_you" name="rent_for_you" value="{{ old('rent_for_you', $post->rent_for_you) }}">
            </div>

            <!-- Facilities -->
            <div class="mb-3">
                <label for="facilities" class="form-label">Facilities</label>
                <input type="text" class="form-control" id="facilities" name="facilities" value="{{ old('facilities', $post->facilities) }}">
            </div>

            <!-- Personal Habits -->
            <div class="mb-3">
                <label for="personal_habbits" class="form-label">Personal Habits</label>
                <input type="text" class="form-control" id="personal_habbits" name="personal_habbits" value="{{ old('personal_habbits', $post->personal_habbits) }}">
            </div>

            <!-- Occupation -->
            <div class="mb-3">
                <label for="ocupation" class="form-label">Occupation</label>
                <select name="ocupation" id="ocupation" class="form-control">
                    <option value="">Select</option>
                    <option value="employed" {{ $post->occupation == 'employed' ? 'selected' : '' }}>Employed</option>
                    <option value="student" {{ $post->occupation == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="unemployed" {{ $post->occupation == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                    <option value="retired" {{ $post->occupation == 'retired' ? 'selected' : '' }}>Retired</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="4">{{ old('notes', $post->notes) }}</textarea>
            </div>

            <!-- Images -->
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
                <div class="mt-2">
                    @foreach ($post->images as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Image" style="height: 100px; margin-right: 10px;">
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Listing</button>
        </form>

    </div>
</main>

</div>

</body>
</html>