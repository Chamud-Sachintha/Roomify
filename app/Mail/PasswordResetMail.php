<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $verificationCode;

    public function __construct($user, $verificationCode)
    {
        $this->user = $user;
        $this->verificationCode = $verificationCode;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Roomyfy Password Reset Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.password_reset',
            with: [
                'user' => $this->user,
                'verificationCode' => $this->verificationCode,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
