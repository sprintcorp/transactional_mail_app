<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;

class DeliveredMailListener
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
     * @param MessageSent $messageSent
     * @return void
     */
    public function handle(MessageSent $messageSent)
    {
        if(!empty($messageSent->mailInformation)){
            $messageSent->mailInformation->setSent();
        }
    }
}
