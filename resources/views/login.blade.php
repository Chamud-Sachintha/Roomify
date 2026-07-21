<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roomyfy | Sign In</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
        :root {
            --bg: #fffaf5;
            --text: #1f2937;
            --muted: #6b7280;
            --card: rgba(255,255,255,0.92);
            --border: rgba(15, 23, 42, 0.08);
            --accent: #ff6b35;
            --accent-dark: #d94a1e;
            --navy: #0f172a;
            --shadow: 0 20px 60px rgba(15, 23, 42, 0.14);
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

        .auth-shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .auth-card {
            width: min(1100px, 100%);
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }

        .auth-hero {
            padding: 40px;
            background: linear-gradient(160deg, rgba(255,255,255,0.9), rgba(255,248,243,0.95));
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--navy);
            margin-bottom: 24px;
        }

        .brand-badge {
            display: inline-grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), #ff9d6d);
            color: white;
            font-size: 1.1rem;
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.28);
        }

        .auth-hero h1 {
            font-size: clamp(1.9rem, 3vw, 2.5rem);
            margin: 0 0 10px;
            color: var(--navy);
            line-height: 1.15;
        }

        .auth-hero p {
            color: var(--muted);
            margin: 0 0 18px;
            line-height: 1.7;
            max-width: 480px;
        }

        .auth-hero ul {
            margin: 0 0 20px 0;
            padding: 0;
            list-style: none;
            display: grid;
            gap: 10px;
        }

        .auth-hero li {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--navy);
            font-weight: 500;
        }

        .auth-hero li::before {
            content: '•';
            color: var(--accent);
            font-size: 1.25rem;
        }

        .ghost-link {
            color: var(--accent-dark);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-form-panel {
            padding: 40px;
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .auth-form-panel h2 {
            font-size: 1.7rem;
            margin-bottom: 6px;
            color: var(--navy);
        }

        .auth-form-panel .subtitle {
            color: var(--muted);
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-control {
            border-radius: 14px;
            border: 1px solid rgba(15, 23, 42, 0.12);
            padding: 13px 14px;
            font-size: 0.95rem;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.18);
        }

        .btn-auth {
            width: 100%;
            border: 0;
            border-radius: 999px;
            padding: 13px 18px;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, var(--accent), var(--accent-dark));
            box-shadow: 0 12px 28px rgba(255, 107, 53, 0.23);
        }

        .btn-auth:hover {
            color: white;
            transform: translateY(-1px);
        }

        .form-check-label {
            color: var(--muted);
            font-size: 0.92rem;
        }

        .alert {
            border-radius: 14px;
            font-size: 0.92rem;
        }

        .auth-footer {
            margin-top: 18px;
            text-align: center;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .auth-footer a {
            color: var(--accent-dark);
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .auth-card {
                grid-template-columns: 1fr;
            }

            .auth-hero {
                padding-bottom: 24px;
            }

            .auth-form-panel {
                padding-top: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-hero">
                <div class="brand">
                    <div class="brand-badge">🏠</div>
                    <div>
                        <div>Roomyfy</div>
                        <small style="display:block; color: var(--muted); font-weight: 500;">Find your next space with ease</small>
                    </div>
                </div>

                <h1>Welcome back</h1>
                <p>Sign in to explore verified listings, manage your next stay, and connect with trusted property options.</p>
                <ul>
                    <li>Fast and secure access</li>
                    <li>Discover curated rooms and homes</li>
                    <li>Stay connected to your account</li>
                </ul>
                <a href="/" class="ghost-link">Back to landing page</a>
            </div>

            <div class="auth-form-panel">
                <h2>Sign in</h2>
                <p class="subtitle">Use your account details to continue</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email address" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="your_pass" class="form-control" placeholder="Password" />
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" name="remember-me" id="remember-me" class="form-check-input" />
                        <label for="remember-me" class="form-check-label">Remember me</label>
                    </div>
                    <button type="submit" class="btn-auth">Log in</button>
                </form>

                <div class="auth-footer">
                    <div class="mb-2">
                        <a href="{{ route('forgot_password_page') }}">Forgot password?</a>
                    </div>
                    Don’t have an account? <a href="/register">Create one</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>