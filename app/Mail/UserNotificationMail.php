<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserNotificationMail extends Mailable
{
    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Уведомление')
            ->view('emails.test');
    }
}
