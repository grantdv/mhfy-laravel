<?php

namespace App\Mail;

use App\Models\OrderRequest;
use Illuminate\Mail\AbstractMessage;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Mail\Mailables\Sideways;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\MailMessage;
use Illuminate\Mail\Messages\Envelope as MailEnvelope;
use Illuminate\Mail\Messages\Body;
use Illuminate\Mail\Messages\Header as MailHeader;
use Illuminate\Mail\Messages\Content as MailContent;
use Illuminate\Mail\Messages\Sideways as MailSideways;
use Illuminate\Mail\Messages\Attachment as MailAttachment;

class PaymentInvoice extends MailMessage
{
    /**
     * Create the mail message.
     * 
     * @param OrderRequest $order
     * @param string $sessionId
     * @return static
     */
    public function __construct(OrderRequest $order, string $sessionId)
    {
        $this->order = $order;
        $this->sessionId = $sessionId;
    }

    /**
     * Build the message.
     * 
     * @return static
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_invoice',
            with: [
                'order' => $this->order,
                'paymentUrl' => route('payment.success', ['order_id' => $this->order->id]) . '?session_id=' . $this->sessionId,
            ],
        );
    }

    /**
     * Build the message headers.
     * 
     * @return Headers
     */
    public function headers(): Headers
    {
        return new Headers(
            subject: "Payment Request: Order #{$this->order->id} | May Harmony Find You",
        );
    }

    /**
     * Build the message envelope.
     * 
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope();
    }

    protected $order;
    protected $sessionId;
}
