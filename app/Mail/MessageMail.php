<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $mailInformation)
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailInformation = $this->mailInformation;

        $mailInformation_config = $this->withSymfonyMessage(function ($message) use($mailInformation) {
                $message->mailInformation = $mailInformation;
            })->from($this->mailInformation->sender)
            ->subject($this->mailInformation->subject)
            ->view('emails.mail_html')
            ->text('emails.mail_text')
            ->with($this->mailInformation->toArray());

        foreach($mailInformation->attachments as $attachment){
            $mailInformation_config->attachFromStorage('attachments/'.$attachment->filename);
        }
        return $mailInformation_config;
    }
}
