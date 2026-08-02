<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Roomyfy Listing Notification</title>
</head>
<body>
    <h1>Roomyfy Notification</h1>

    @if ($notificationType === 'created')
        <p>Your listing has been submitted successfully and is now pending admin approval.</p>
    @elseif ($notificationType === 'approved')
        <p>Great news! Your listing has been approved by admin.</p>
    @elseif ($notificationType === 'rejected')
        <p>Unfortunately, your listing has been rejected by admin.</p>
    @endif

    <p><strong>Listing:</strong> {{ $listing->display_name ?? 'No title' }}</p>
    <p><strong>Location:</strong> {{ $listing->location }}</p>

    @if ($notificationType === 'rejected' && $remark)
        <p><strong>Remark:</strong> {{ $remark }}</p>
    @endif

    <p>To review your listing, log in to your account and visit your listings page.</p>
    <p>Thank you for using Roomyfy.</p>
</body>
</html>
