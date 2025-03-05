<?php

namespace Modules\Store\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Store\Entities\Story;
use Modules\Store\Notifications\NewStoryCreatedNotifiaction;
use Modules\Store\Notifications\NewStoryReactionNotifiaction;

class SendNotifiactionToSellerUserReaction implements ShouldQueue
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
        $seller = $event->story->store->seller;
        $seller->notify(new NewStoryReactionNotifiaction($event->story,$event->user_id));
    }
}
