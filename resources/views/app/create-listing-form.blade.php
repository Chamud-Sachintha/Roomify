<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kiaalap - Modern Education Management Dashboard for Universities">
    <meta name="keywords" content="education, dashboard, university, management, admin">
    <meta name="author" content="Kiaalap">

    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin="">
    <link rel="preconnect" href="https://ui-avatars.com" crossorigin="">
    <link rel="dns-prefetch" href="https://flagcdn.com">

    <title>Dashboard - Kiaalap Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon-9EIT7vLh.ico') }}">

    <script type="module" crossorigin="" src="{{ asset('dashboard/js/main-DEP3gGTG.js') }}"></script>
    <link rel="stylesheet" crossorigin="" href="{{ asset('dashboard/css/dashboard-CN5n4iss.css') }}">

    <style>
        .chips-box {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 10px;
            min-height: 48px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            background: #fff;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            background: #0d6efd;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            animation: fadeIn 0.2s ease-in-out;
        }

        .chip:hover {
            background: #0b5ed7;
        }

        .chip-remove {
            margin-left: 8px;
            cursor: pointer;
            font-weight: bold;
            color: #fff;
            opacity: 0.8;
        }

        .chip-remove:hover {
            opacity: 1;
        }

        .chips-input {
            border: none;
            outline: none;
            flex-grow: 1;
            min-width: 120px;
            padding: 5px;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

</head>

<body>

    @include('app.sidebar_menu')

    <!-- Main Content Wrapper -->
    <div class="main-wrapper" id="mainWrapper">

        @include('app.header')

        <!-- Main Content -->
        <main class="dashboard-content" id="main-content">
            <div class="container-fluid">
                <div class="mb-3">
                    <h1 class="h3 font-bold">Create New Post</h1>
                    <p class="text-muted text-sm">Welcome back! Here's what's happening with your institution today.</p>
                </div>

                <div class="dashboard-grid grid-cols-12">
                    <!-- Recent Students -->
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
                            <div class="d-flex justify-content-center">
                                <form action="{{ route('create_new_listing') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <!-- Display Name -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Display Name</label>
                                            <input type="text" name="display_name" class="form-control">
                                        </div>

                                        <!-- Location -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control">
                                        </div>

                                        <!-- Number of Persons -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Number of Persons</label>
                                            <input type="number" name="number_of_persons" class="form-control">
                                        </div>

                                        <!-- Total Rent -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Total Rent</label>
                                            <input type="number" name="total_rent" class="form-control">
                                        </div>

                                        <!-- Rent for You -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Rent for You</label>
                                            <input type="number" name="rent_for_you" class="form-control">
                                        </div>

                                        <!-- Floor -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Floor</label>
                                            <select name="floor" class="form-control">
                                                <option value="">Select Floor</option>
                                                <option value="ground">Ground</option>
                                                <option value="first">First</option>
                                                <option value="second">Second</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <!-- Elevator -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Has Elevator?</label>
                                            <select name="has_elevator" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <!-- Has Parking -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Has Parking?</label>
                                            <select name="has_parking" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <!-- Occupation -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Occupation</label>
                                            <select name="ocupation" class="form-control">
                                                <option value="">Select</option>
                                                <option value="employed">Employed</option>
                                                <option value="student">Student</option>
                                                <option value="unemployed">Unemployed</option>
                                                <option value="retired">Retired</option>
                                            </select>
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="">Select</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <!-- Category Type -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Category Type</label>
                                            <select name="category_type_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- contact details -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Contact Number</label>
                                            <input type="text" name="contact_number" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Contact Email</label>
                                            <input type="email" name="contact_email" class="form-control">
                                        </div>

                                        <!-- Facilities -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Facilities</label>

                                            <div id="facilities-container" class="chips-box">
                                                <input type="text" id="facilities-input" class="chips-input"
                                                    placeholder="Type and press Enter">
                                            </div>

                                            <input type="hidden" name="facilities" id="facilities-hidden">
                                        </div>

                                        <!-- Personal Habits -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Personal Habits</label>

                                            <div id="habits-container" class="chips-box">
                                                <input type="text" id="habits-input" class="chips-input"
                                                    placeholder="Type and press Enter">
                                            </div>

                                            <input type="hidden" name="personal_habbits" id="habits-hidden">
                                        </div>

                                        <!-- Notes -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Notes</label>
                                            <textarea name="notes" class="form-control" rows="3"></textarea>
                                        </div>

                                        <!-- Images -->
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Images (Max 3)</label>
                                            <input type="file" class="form-control" name="images[]" multiple>
                                        </div>

                                        <!-- Submit -->
                                        <div class="col-12">
                                            <button class="btn btn-primary px-4">Submit</button>
                                            <button type="reset" class="btn btn-secondary px-4">Clear Form</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function initChips(boxId, inputId, hiddenId) {
            const box = document.getElementById(boxId);
            const input = document.getElementById(inputId);
            const hidden = document.getElementById(hiddenId);

            let chips = [];

            input.addEventListener("keydown", (e) => {
                if (e.key === "Enter" && input.value.trim() !== "") {
                    e.preventDefault();

                    const value = input.value.trim();
                    chips.push(value);

                    renderChips();
                    input.value = "";
                }
            });

            function renderChips() {
                box.querySelectorAll(".chip").forEach(c => c.remove());

                chips.forEach((text, index) => {
                    const chip = document.createElement("div");
                    chip.classList.add("chip");
                    chip.innerHTML = `${text} <span class="chip-remove" data-index="${index}">&times;</span>`;

                    chip.querySelector(".chip-remove").addEventListener("click", () => {
                        chips.splice(index, 1);
                        renderChips();
                    });

                    box.insertBefore(chip, input);
                });

                hidden.value = chips.join(",");
            }
        }

        initChips("facilities-container", "facilities-input", "facilities-hidden");
        initChips("habits-container", "habits-input", "habits-hidden");
    </script>

</body>