<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Roomyfy') }} | Find Your Next Space</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            :root {
                --bg: #fffaf5;
                --text: #1f2937;
                --muted: #6b7280;
                --card: rgba(255,255,255,0.82);
                --border: rgba(15, 23, 42, 0.08);
                --accent: #ff6b35;
                --accent-dark: #d94a1e;
                --navy: #0f172a;
                --shadow: 0 20px 60px rgba(15, 23, 42, 0.12);
            }

            * { box-sizing: border-box; }
            body {
                margin: 0;
                min-height: 100vh;
                font-family: 'Instrument Sans', sans-serif;
                background:
                    radial-gradient(circle at top left, rgba(255, 107, 53, 0.18), transparent 22%),
                    radial-gradient(circle at top right, rgba(56, 189, 248, 0.16), transparent 24%),
                    var(--bg);
                color: var(--text);
            }

            .container {
                width: min(1180px, calc(100% - 32px));
                margin: 0 auto;
            }

            .topbar {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 20px 0;
            }

            .brand {
                display: flex;
                align-items: center;
                gap: 12px;
                font-weight: 700;
                font-size: 1.15rem;
                color: var(--navy);
            }

            .brand-badge {
                display: inline-grid;
                place-items: center;
                width: 42px;
                height: 42px;
                border-radius: 14px;
                background: linear-gradient(135deg, var(--accent), #ff9d6d);
                color: white;
                font-size: 1.15rem;
                box-shadow: 0 10px 30px rgba(255, 107, 53, 0.35);
            }

            .nav-actions {
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 12px 18px;
                border-radius: 999px;
                text-decoration: none;
                font-weight: 600;
                transition: 0.2s ease;
            }

            .btn-secondary {
                color: var(--navy);
                background: rgba(255,255,255,0.85);
                border: 1px solid rgba(15, 23, 42, 0.1);
            }

            .btn-primary {
                color: white;
                background: linear-gradient(135deg, var(--accent), var(--accent-dark));
                box-shadow: 0 14px 30px rgba(255, 107, 53, 0.22);
            }

            .btn:hover {
                transform: translateY(-1px);
            }

            .hero {
                display: grid;
                grid-template-columns: 1.1fr 0.9fr;
                gap: 36px;
                align-items: center;
                padding: 40px 0 70px;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 7px 12px;
                border-radius: 999px;
                background: rgba(255, 107, 53, 0.12);
                color: var(--accent-dark);
                font-size: 0.85rem;
                font-weight: 700;
                margin-bottom: 18px;
            }

            h1 {
                margin: 0 0 16px;
                font-size: clamp(2.5rem, 5vw, 4.4rem);
                line-height: 1.02;
                letter-spacing: -0.04em;
                color: var(--navy);
            }

            .hero p {
                margin: 0;
                color: var(--muted);
                font-size: 1.05rem;
                line-height: 1.8;
                max-width: 640px;
            }

            .hero-actions {
                display: flex;
                gap: 14px;
                margin-top: 26px;
                flex-wrap: wrap;
            }

            .mini-stats {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 12px;
                margin-top: 30px;
            }

            .mini-stat {
                padding: 16px;
                border-radius: 18px;
                background: rgba(255,255,255,0.75);
                border: 1px solid var(--border);
                backdrop-filter: blur(8px);
            }

            .mini-stat strong {
                display: block;
                font-size: 1.15rem;
                color: var(--navy);
            }

            .mini-stat span {
                display: block;
                margin-top: 4px;
                color: var(--muted);
                font-size: 0.88rem;
            }

            .hero-card {
                background: linear-gradient(180deg, rgba(255,255,255,0.82), rgba(255,248,243,0.92));
                border: 1px solid rgba(15,23,42,0.08);
                border-radius: 28px;
                padding: 26px;
                box-shadow: var(--shadow);
                backdrop-filter: blur(10px);
            }

            .hero-card .card-top {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 18px;
            }

            .pill {
                padding: 8px 12px;
                border-radius: 999px;
                background: rgba(15,23,42,0.06);
                color: var(--navy);
                font-weight: 700;
                font-size: 0.78rem;
            }

            .listings-stack {
                display: grid;
                gap: 14px;
            }

            .listing-preview {
                padding: 18px;
                border-radius: 20px;
                background: white;
                border: 1px solid rgba(15,23,42,0.08);
            }

            .listing-preview .image {
                height: 190px;
                border-radius: 18px;
                margin-bottom: 16px;
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                background-image:
                    linear-gradient(160deg, rgba(255,107,53,0.16), rgba(34,197,94,0.12)),
                    linear-gradient(135deg, #0f172a, #1f2937);
            }

            .listing-preview h3 {
                margin: 0 0 8px;
                font-size: 1.15rem;
                color: var(--navy);
            }

            .listing-preview p {
                margin: 0;
                color: var(--muted);
                line-height: 1.6;
                font-size: 0.93rem;
            }

            .listing-meta {
                display: flex;
                justify-content: space-between;
                gap: 12px;
                margin-top: 16px;
                font-size: 0.88rem;
                color: var(--muted);
            }

            .empty-state {
                padding: 18px;
                border-radius: 18px;
                background: rgba(255,255,255,0.7);
                border: 1px dashed rgba(15,23,42,0.18);
                color: var(--muted);
            }

            .section-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px;
                margin: 0 0 50px;
            }

            .feature-card {
                background: rgba(255,255,255,0.78);
                border: 1px solid var(--border);
                border-radius: 22px;
                padding: 22px;
            }

            .feature-card h3 {
                margin: 14px 0 8px;
                font-size: 1.05rem;
                color: var(--navy);
            }

            .feature-card p {
                margin: 0;
                color: var(--muted);
                line-height: 1.7;
                font-size: 0.93rem;
            }

            .icon-wrap {
                width: 48px;
                height: 48px;
                border-radius: 14px;
                display: grid;
                place-items: center;
                background: rgba(255,107,53,0.12);
                color: var(--accent-dark);
                font-size: 1.2rem;
                font-weight: 800;
            }

            .footer-note {
                padding: 24px 0 50px;
                text-align: center;
                color: var(--muted);
                font-size: 0.92rem;
            }

            @media (max-width: 900px) {
                .hero,
                .section-grid {
                    grid-template-columns: 1fr;
                }

                .topbar {
                    flex-direction: column;
                    gap: 16px;
                }

                .nav-actions {
                    width: 100%;
                    justify-content: center;
                    flex-wrap: wrap;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header class="topbar">
                <div class="brand">
                    <span class="brand-badge">R</span>
                    <span>Roomyfy</span>
                </div>

                <nav class="nav-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Open Dashboard</a>
                    @else
                        <a href="{{ route('login_page') }}" class="btn btn-secondary">Login</a>
                        <a href="{{ route('register_page') }}" class="btn btn-primary">Register</a>
                    @endauth
                </nav>
            </header>

            <section class="hero">
                <div>
                    <div class="eyebrow">🏠 Smart spaces for modern living</div>
                    <h1>List, discover, and manage rooms with confidence.</h1>
                    <p>
                        Roomyfy helps people connect with trusted room and rental listings faster. From single room searches to owner-ready management tools, everything is built to make property discovery simple and professional.
                    </p>

                    <div class="hero-actions">
                        @guest
                            <a href="{{ route('register_page') }}" class="btn btn-primary">Create Free Account</a>
                            <a href="{{ route('login_page') }}" class="btn btn-secondary">Already a member?</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                        @endguest
                    </div>

                    <div class="mini-stats">
                        <div class="mini-stat">
                            <strong>{{ $featuredListings->count() }}</strong>
                            <span>Approved listings</span>
                        </div>
                        <div class="mini-stat">
                            <strong>24/7</strong>
                            <span>Easy communication</span>
                        </div>
                        <div class="mini-stat">
                            <strong>98%</strong>
                            <span>Client satisfaction</span>
                        </div>
                    </div>
                </div>

                <div class="hero-card">
                    <div class="card-top">
                        <span class="pill">Approved Listings</span>
                        <span class="pill">Live on Roomyfy</span>
                    </div>

                    <div class="listings-stack">
                        @forelse ($featuredListings->take(1) as $listing)
                            @php
                                $images = !empty($listing->images) ? explode(',', $listing->images) : [];
                                $primaryImage = $images[0] ?? '';
                                $listingImage = $primaryImage ? asset('storage/' . $primaryImage) : '';
                            @endphp

                            <div class="listing-preview">
                                <div
                                    class="image"
                                    style="background-image: linear-gradient(160deg, rgba(255,107,53,0.16), rgba(34,197,94,0.12)), url('{{ $listingImage }}');">
                                </div>

                                <h3>{{ $listing->display_name ?? 'Room Listing' }}</h3>

                                <p>
                                    {{ $listing->notes ?: 'Premium room available for quick move-in.' }}
                                </p>

                                <div class="listing-meta">
                                    <span>{{ $listing->location ?? 'Location not set' }}</span>
                                    <span>LKR {{ number_format($listing->rent_for_you ?? 0, 2) }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                No approved listings are available at the moment. Please check back soon.
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="section-grid">
                <article class="feature-card">
                    <div class="icon-wrap">01</div>
                    <h3>Simple search experience</h3>
                    <p>Browse premium room listings with a fast and intuitive search flow designed for modern users.</p>
                </article>

                <article class="feature-card">
                    <div class="icon-wrap">02</div>
                    <h3>Trusted listing management</h3>
                    <p>Owners can publish, update, and monitor listing details with a clean dashboard experience.</p>
                </article>

                <article class="feature-card">
                    <div class="icon-wrap">03</div>
                    <h3>Secure account access</h3>
                    <p>Join quickly with a polished login and registration flow that keeps the experience smooth.</p>
                </article>
            </section>

            <div class="footer-note">
                Roomyfy � modern rental discovery, designed for trust and convenience.
            </div>
        </div>
    </body>
</html>
