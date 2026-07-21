<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>

    <p>You requested a password reset for your Roomyfy account.</p>

    <p>Your password reset code is:</p>

    <p><strong>{{ $verificationCode }}</strong></p>

    <p>Use this code on the reset password page to continue.</p>

    <p>If you didn't request this, please ignore this email.</p>
</body>
</html>
