<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListingApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Property $property
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Property Listing Has Been Approved',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.listing-approved',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
