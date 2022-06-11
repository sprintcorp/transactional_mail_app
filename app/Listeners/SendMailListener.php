<?php

namespace App\Listeners;

use App\Events\SendMailEvent;
use App\Mail\MessageMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendMailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendMailEvent  $event
     * @return void
     */
    public function handle(SendMailEvent $event)
    {
        try {
            Mail::to($event->mailInformation->recipient)
                ->send(new MessageMail($event->mailInformation));
            $event->mailInformation->setSent();
        }catch (\Exception $exception){
            $event->mailInformation->setFailed($exception->getMessage());
        }
    }
}
