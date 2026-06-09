<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order,
        public string $changeType,
        public string $oldStatus,
        public string $newStatus,
    ) {}

    public function envelope(): Envelope
    {
        $subject = match ($this->changeType) {
            'order' => "Order #{$this->order->order_number} - Status: " . ucfirst($this->newStatus),
            'payment' => "Order #{$this->order->order_number} - Payment: " . ucfirst($this->newStatus),
            default => "Order #{$this->order->order_number} Update",
        };

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.order-status-updated');
    }
}
