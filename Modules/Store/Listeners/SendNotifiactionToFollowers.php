<?php

namespace Modules\Store\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Store\Notifications\NewStoryCreatedNotifiaction;

class SendNotifiactionToFollowers implements ShouldQueue
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
    public function handle($event)
    {
        $followers = $event->story->store->followers()->get();
        foreach ($followers as $follower) {
            $follower->notify(new NewStoryCreatedNotifiaction($event->story));
        }
    }
}
