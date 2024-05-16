<?php

namespace App\Mail\Order;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderUserMail extends Mailable
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
        return new Envelope(
            subject: 'Update on Your Trip',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        switch ($this->data['status']) {
            case 'Completed':
                return new Content(
                    markdown: 'admins.emails.order.user.order_complete',
                );
            case 'Actived':
                return new Content(
                    markdown: 'admins.emails.order.user.order_active',
                );
            case 'Pending':
                return new Content(
                    markdown: 'admins.emails.order.user.order_pending',
                );
            case 'Canceled':
                return new Content(
                    markdown: 'admins.emails.order.user.order_cancel',
                );
            case 'Rejected':
                return new Content(
                    markdown: 'admins.emails.order.user.order_reject',
                );
            default:
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
