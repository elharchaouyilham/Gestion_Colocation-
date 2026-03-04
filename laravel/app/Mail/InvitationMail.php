<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly Invitation $invitation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation à rejoindre une colocation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.invitation',
            with: [
                'invitation' => $this->invitation,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
