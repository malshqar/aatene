<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Admin;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Admin::create([
            'name' => 'الأدمن محمد',
            'email'=>'example-admin@aatene.app',
            'password'=>bcrypt('Pa$$w0rd!'),
            'email_verified_at'=>now(),
            'phone_number'=>'+1 123 456 6789',
        ]);
        // $this->call("OthersTableSeeder");
    }
}
