<?php

namespace Modules\Seller\Listeners;

use Modules\Seller\Events\SellerBlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Seller\Events\SellerCancelBlocked;
use Modules\Seller\Notifications\SellerBlockedCancelNotifications;

class SendBlockedCancelNotification
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
     * @param SellerBlocked $event
     * @return void
     */
    public function handle(SellerCancelBlocked $event)
    {
        $event->seller->notify((new SellerBlockedCancelNotifications()));
    }
}
