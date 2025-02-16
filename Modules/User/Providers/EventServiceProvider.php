<?php

namespace Modules\User\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\User\Events\UserBlocked;
use Modules\User\Listeners\SendBlockedNotification;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserBlocked::class => [
            SendBlockedNotification::class,
        ],
    ];
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
