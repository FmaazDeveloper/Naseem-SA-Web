<?php

namespace App\Mail\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public array $data)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $role = $this->data['role'];

        if ($role == 'tourist') {
            return new Envelope(
                subject: 'Order Request Confirmation',
            );
        } elseif ($role == 'guide') {
            return new Envelope(
                subject: 'New Order Received',
            );
        } else {
            return new Envelope(
                subject: '',
            );
        }
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $role = $this->data['role'];

        if ($role == 'tourist') {
            return new Content(
                markdown: 'admins.emails.order.tourist.order_request',
            );
        } elseif ($role == 'guide') {
            return new Content(
                markdown: 'admins.emails.order.guide.order_request',
            );
        } else {
            return new Content(
                markdown: '',
            );
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
