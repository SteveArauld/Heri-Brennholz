<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        public string $name,
        public string $email,
        public ?string $contactSubject,
        public string $body,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kontaktformular: ' . ($this->contactSubject ?: 'Anfrage'),
            replyTo: [new \Illuminate\Mail\Mailables\Address($this->email, $this->name)],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}
