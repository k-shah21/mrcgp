<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationRejected extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public Application $application)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your MRCGP Application Status Update',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
