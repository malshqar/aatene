<?php

namespace Modules\Seller\Jobs;

use Event;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Attributes\WithoutRelations;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Events\SellerCancelBlocked;

class CheckBanSellersDateFinishedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $sellers = Seller::where('ban_at', '<=', now())->get();
        \DB::table('sellers')->where('ban_at', '<=', now())->update([
            'ban_reason' => null,
            'ban_at' => null,
        ]);
        foreach ($sellers??[] as $seller) {
            SellerCancelBlocked::dispatch($seller);
        }
    }
}
