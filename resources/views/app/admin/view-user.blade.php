<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - Roomyfy</title>

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

        .profile-picture-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;
        }

        .profile-picture-preview img {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-picture-preview img:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .profile-picture-label {
            display: block;
            text-align: center;
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>

<body>

@include('app.sidebar_menu')

<div class="main-wrapper" id="mainWrapper">

@include('app.header')

<main class="dashboard-content" id="main-content">
    <div class="container-fluid">

        @php
            $showUser = $managedUser ?? auth()->user();
        @endphp

        <!-- Page Title -->
        <div class="mb-4">
            <h1 class="h3 font-bold">👤 User Details</h1>
            <p class="text-muted">Viewing user profile for {{ $showUser->name ?? 'Unknown User' }}.</p>
        </div>

        <div class="mb-4">
            <a href="{{ route('manage_all_users') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to User Management</a>
        </div>

        <!-- Profile Settings Form -->
        <form action="{{ route('save_profile_settings') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @php
                $showUser = $managedUser ?? auth()->user();
            @endphp

            <input type="hidden" name="admin_viewed_user_id" value="{{ $showUser->id ?? '' }}">

            <!-- Display Name -->
            <div class="mb-3">
                <label for="display_name" class="form-label">Display Name</label>
                <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $settings->display_name ?? $showUser->name ?? '' }}" required>
            </div>

            <!-- Profile Picture -->
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <div class="profile-picture-preview">
                    @if(isset($settings->profile_picture))
                        <img id="profilePicturePreview" src="{{ asset('storage/' . $settings->profile_picture) }}" alt="Profile Picture">
                    @else
                        <img id="profilePicturePreview" src="" alt="Profile Picture" style="display: none;">
                    @endif
                </div>
            </div>

            <!-- First Name -->
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $settings->first_name ?? $showUser->first_name ?? '' }}">
            </div>

            <!-- Last Name -->
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $settings->last_name ?? $showUser->last_name ?? '' }}">
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $settings->phone_number ?? $showUser->phone_number ?? '' }}">
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="male" {{ (isset($settings->gender) && $settings->gender == 'male') || (!isset($settings->gender) && ($showUser->gender ?? '') == 'male') ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ (isset($settings->gender) && $settings->gender == 'female') || (!isset($settings->gender) && ($showUser->gender ?? '') == 'female') ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ (isset($settings->gender) && $settings->gender == 'other') || (!isset($settings->gender) && ($showUser->gender ?? '') == 'other') ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <!-- Date of Birth -->
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ $settings->date_of_birth ?? $showUser->date_of_birth ?? '' }}">
            </div>

            <!-- Occupation -->
            <div class="mb-3">
                <label for="occupation" class="form-label">Occupation</label>
                <input type="text" class="form-control" id="occupation" name="occupation" value="{{ $settings->occupation ?? $showUser->occupation ?? '' }}">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $settings->email ?? $showUser->email ?? '' }}" required>
            </div>

            <!-- Bio -->
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" id="bio" name="bio" rows="4">{{ $settings->bio ?? $showUser->bio ?? '' }}</textarea>
            </div>
        </form>

    </div>
</main>

</div>

<script>
    function previewProfilePicture(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('profilePicturePreview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>