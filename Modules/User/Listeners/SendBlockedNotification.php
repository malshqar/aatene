<?php

namespace Modules\User\Listeners;

use Mail;
use Modules\User\Emails\UserBlockedMail;
use Modules\User\Events\UserBlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\User\Notifications\UserBlockedNotifications;

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
     * @param UserBlocked $event
     * @return void
     */
    public function handle(UserBlocked $event)
    {
        $event->user->notify((new UserBlockedNotifications($event->user)));
    }
}
