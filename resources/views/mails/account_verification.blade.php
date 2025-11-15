<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>

    <p>Your account has been created. Please verify your email by clicking the link below:</p>

    <p>
        {{ $verificationCode }}
    </p>

    <p>If you didn't request this, please ignore.</p>
</body>
</html>