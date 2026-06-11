<?php
namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly ContactMessage $contactMessage) {}

    public function envelope(): Envelope {
        return new Envelope(
            subject: '[ACC Contact] '.$this->contactMessage->subject,
            replyTo: [$this->contactMessage->email],
        );
    }

    public function content(): Content {
        return new Content(view: 'emails.contact');
    }
}
