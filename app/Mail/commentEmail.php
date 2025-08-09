<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class commentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $comment;
    public function __construct($userName,$comment)
    {
        $this->userName = $userName;
        $this->comment = $comment;
    }

    public function build()
    {
        return $this->subject('Comment')
                    ->view('emails.commentMail');
    }
}
