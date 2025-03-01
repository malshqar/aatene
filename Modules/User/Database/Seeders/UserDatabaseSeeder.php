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
            'name' => 'المستخدم محمد',
            'email'=>'example-user@aatene.app',
            'password'=>bcrypt('Pa$$w0rd!'),
            'email_verified_at'=>now(),
            'phone_number'=>'+1 123 456 6789',
        ]);
        // $this->call("OthersTableSeeder");
    }
}
