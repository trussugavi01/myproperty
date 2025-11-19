<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListingRejected extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Property $property
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Required for Your Property Listing',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.listing-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
