<?php

namespace App\Mail;

use App\Models\ClientVerificationDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationRequestNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public ClientVerificationDocument $document;
    public string $notificationType;
    public ?string $remark;

    public function __construct(ClientVerificationDocument $document, string $notificationType, ?string $remark = null)
    {
        $this->document = $document;
        $this->notificationType = $notificationType;
        $this->remark = $remark;
    }

    public function envelope(): Envelope
    {
        $subject = $this->notificationType === 'approved'
            ? 'Verification Request Approved'
            : 'Verification Request Rejected';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.verification_request_notification',
            with: [
                'document' => $this->document,
                'notificationType' => $this->notificationType,
                'remark' => $this->remark,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
