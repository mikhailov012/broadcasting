<?php

namespace App\Listeners;

use App\Events\MessagePushed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPushNotification
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
     * @param  MessagePushed  $event
     * @return void
     */
    public function handle(MessagePushed $event)
    {
        //
    }
}
