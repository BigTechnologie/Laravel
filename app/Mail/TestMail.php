<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable 
{
    use Queueable, SerializesModels; // Queueable aulieu ShouldQueue

    public $messageContent; 
    public $attachment;     
   
    public function __construct($messageContent, $attachment = null)
    {
        $this->messageContent = $messageContent;
        $this->attachment = $attachment;
    }
  
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('dev.technologie2018@gmail.com', 'Admin'),
            subject: 'Message Laravel avec pièce jointe'
        );
    }
 
    public function content(): Content
    {
        return new Content(
            view: 'emails.test', 
            with: ['messageContent' => $this->messageContent] 
        );
    }
   
    public function attachments(): array
    {
       
        return $this->attachment ? [
            \Illuminate\Mail\Mailables\Attachment::fromPath($this->attachment->getRealPath()) 
                ->as($this->attachment->getClientOriginalName())  
                ->withMime($this->attachment->getMimeType())      
        ] : [];
    }
}
