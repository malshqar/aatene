<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Seller\Jobs\CheckBanSellersDateFinishedJob;
use Modules\Store\Jobs\DeleteExpiredStory;
use Modules\User\Jobs\CheckBanUsersDateFinishedJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new CheckBanUsersDateFinishedJob())->everyTenSeconds();
        $schedule->job(new CheckBanSellersDateFinishedJob())->everyTenSeconds();
        $schedule->job(new DeleteExpiredStory())->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
