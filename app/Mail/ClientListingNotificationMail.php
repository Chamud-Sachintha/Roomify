<?php

namespace App\Mail;

use App\Models\ClientListing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientListingNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public ClientListing $listing;
    public $notificationType;
    public $remark;

    public function __construct(ClientListing $listing, string $notificationType = 'created', ?string $remark = null)
    {
        $this->listing = $listing;
        $this->notificationType = $notificationType;
        $this->remark = $remark;
    }

    public function envelope(): Envelope
    {
        $subject = match ($this->notificationType) {
            'approved' => 'Your listing has been approved',
            'rejected' => 'Your listing has been rejected',
            default => 'Your listing has been submitted',
        };

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.client_listing_notification',
            with: [
                'listing' => $this->listing,
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
