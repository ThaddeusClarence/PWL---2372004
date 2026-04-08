<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $qrCode;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order->load(['event', 'tickets.ticketType', 'user']);
        
        // Ambil tiket pertama (Asumsi 1 order 1 tiket untuk simulasi ini)
        $ticket = $this->order->tickets->first();
        
        // Generate QR Code sebagai Base64
        $this->qrCode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($ticket->ticket_code));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'E-Ticket EventMaster: ' . $this->order->event->title,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
