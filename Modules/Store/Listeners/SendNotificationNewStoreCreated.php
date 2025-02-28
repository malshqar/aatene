<?php

namespace Modules\Store\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Admin\Entities\Admin;
use Modules\Store\Events\StoreCreated;
use Modules\Store\Notifications\StoreCreatedNotification;

class SendNotificationNewStoreCreated implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(StoreCreated $event)
    {
        // todo: add condition get admin who has store permissions 
        $admins = Admin::get();
        foreach ($admins as $admin) {
            $admin->notify(new StoreCreatedNotification($event->store));
        }
    }

    
}
