<?php

namespace Modules\AccessControl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccessControlDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create roles and assign created permissions
        // this can be done as separate statements

        // $permissions = Permission::pluck('id','id')->all();

        // $role->syncPermissions($permissions);

        $permissions = [
            //users table permissions
            'user.index',
            'user.create',
            'user.show',
            'user.edit',
            'user.delete',
            'user.ban',
            'user.cancel.ban',
            // admins table permissions
            'admin.index',
            'admin.create',
            'admin.show',
            'admin.edit',
            'admin.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'module_name' => 'Admin','guard_name'=>'admin']);
        }
        $role = Role::create(['name' => 'super_admin','guard_name'=>'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
