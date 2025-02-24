<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::create([
            'name' => ' محمد',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('Pa$$w0rd!'),
            'email_verified_at'=>now(),
            'phone_number'=>'+1 234 5678',
        ]);
        // $this->call("OthersTableSeeder");
    }
}
