<?php

namespace App\Jobs;

use App\Mail\SendTicketMail;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTicketJob implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Pastikan order masih ada
        if (!$this->order) return;

        // Ambil email user
        $recipient = $this->order->user->email;

        // Kirim Mail via Mailable yang sudah ada
        Mail::to($recipient)->send(new SendTicketMail($this->order));
    }
}
