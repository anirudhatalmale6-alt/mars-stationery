<?php

namespace App\Mail;

use App\Models\BulkInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkInquiryReply extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public BulkInquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: "Re: Your Bulk Inquiry - Mars Stationery");
    }

    public function content(): Content
    {
        return new Content(view: 'emails.inquiry-reply');
    }
}
