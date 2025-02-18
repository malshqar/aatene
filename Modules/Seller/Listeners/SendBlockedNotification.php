<?php

namespace Modules\Seller\Listeners;

use Mail;
use Modules\Seller\Emails\SellerBlockedMail;
use Modules\Seller\Events\SellerBlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Seller\Notifications\SellerBlockedNotifications;

class SendBlockedNotification implements ShouldQueue
{

    use InteractsWithQueue;
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
     * @param SellerBlocked $event
     * @return void
     */
    public function handle(SellerBlocked $event)
    {
        $event->seller->notify((new SellerBlockedNotifications($event->seller)));
    }
}
