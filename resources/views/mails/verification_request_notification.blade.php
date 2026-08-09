<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Request Notification</title>
</head>
<body>
    <h2>Hello {{ $document->client->name }},</h2>

    @if ($notificationType === 'approved')
        <p>Your verification document has been approved.</p>
        <p>Your account is now verified and you can proceed with listings.</p>
    @else
        <p>Your verification document has been rejected.</p>
        <p>Please review the remark below and submit a new document if needed.</p>
    @endif

    <p><strong>Document Type:</strong> {{ $document->documentType->name }}</p>
    <p><strong>Full Name:</strong> {{ $document->full_name }}</p>
    <p><strong>Status:</strong> {{ ucfirst($notificationType) }}</p>

    @if ($remark)
        <p><strong>Remark:</strong> {{ $remark }}</p>
    @endif

    <p>If you have questions, please contact support.</p>
</body>
</html>
