<?php

namespace Modules\Seller\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Seller\Entities\Seller;

class SellerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Seller::create([
            'name' => ' محمد',
            'email'=>'seller@gmail.com',
            'password'=>bcrypt('Pa$$w0rd!'),
            'email_verified_at'=>now(),
            'phone_number'=>'+1 234 5678',
            'gold_coins'=>1000000
        ]);
        // $this->call("OthersTableSeeder");
    }
}
