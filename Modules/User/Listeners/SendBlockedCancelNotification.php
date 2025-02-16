<?php

namespace Modules\User\Listeners;

use Modules\User\Events\UserBlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Events\UserCancelBlocked;
use Modules\User\Notifications\UserBlockedCancelNotifications;

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
     * @param UserBlocked $event
     * @return void
     */
    public function handle(UserCancelBlocked $event)
    {
        $event->user->notify(new UserBlockedCancelNotifications());

    }
}
