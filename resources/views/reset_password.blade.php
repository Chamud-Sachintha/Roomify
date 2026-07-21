<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roomyfy | Reset Password</title>

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
        .auth-shell { min-height: 100vh; display: grid; place-items: center; padding: 24px; }
        .auth-card {
            width: min(900px, 100%);
            display: grid;
            grid-template-columns: 1fr;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
        }
        .auth-form-panel { padding: 40px; background: white; }
        .brand { display:flex; align-items:center; gap:12px; font-weight:700; color:var(--navy); margin-bottom:20px; }
        .brand-badge { width:44px; height:44px; border-radius:14px; display:grid; place-items:center; background: linear-gradient(135deg, var(--accent), #ff9d6d); color:white; }
        h2 { color: var(--navy); margin-bottom:6px; }
        .subtitle { color: var(--muted); margin-bottom: 24px; }
        .form-control { border-radius: 14px; border: 1px solid rgba(15, 23, 42, 0.12); padding: 13px 14px; }
        .form-control:focus { border-color: var(--accent); box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.18); }
        .btn-auth { width: 100%; border:0; border-radius:999px; padding:13px 18px; color:white; background: linear-gradient(135deg, var(--accent), var(--accent-dark)); font-weight:700; }
        .auth-footer { margin-top: 18px; text-align: center; color: var(--muted); }
        .auth-footer a { color: var(--accent-dark); text-decoration:none; font-weight:600; }
        .alert { border-radius: 14px; font-size:0.92rem; }
    </style>
</head>
<body>
    <div class="auth-shell">
        <div class="auth-card">
            <div class="auth-form-panel">
                <div class="brand">
                    <div class="brand-badge">🏠</div>
                    <div>Roomyfy</div>
                </div>

                <h2>Reset password</h2>
                <p class="subtitle">Enter the code from your email and choose a new password.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reset_password') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <div class="form-group mb-3">
                        <input type="text" name="otp_code" class="form-control" placeholder="Enter reset code" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="New password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn-auth">Update password</button>
                </form>

                <div class="auth-footer">
                    Need another code? <a href="{{ route('forgot_password_page') }}">Request again</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
