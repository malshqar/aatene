<?php

namespace Modules\AccessControl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Admin;
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
            //users table permissions
            'store.index',
            'store.create',
            'store.show',
            'store.edit',
            'store.delete',
            'store.ban',
            'store.cancel.ban',
            //sellers table permissions
            'seller.index',
            'seller.create',
            'seller.show',
            'seller.edit',
            'seller.delete',
            'seller.ban',
            'seller.cancel.ban',
            // admins table permissions
            'admin.index',
            'admin.create',
            'admin.show',
            'admin.edit',
            'admin.delete',
            // roles table permissions
            'role.index',
            'role.create',
            'role.show',
            'role.edit',
            'role.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'module_name' => 'Admin', 'guard_name' => 'admin']);
        }
        $role = Role::create(['name' => 'super_admin', 'guard_name' => 'admin']);
        // $role = Role::first();
        $admin = Admin::create([
            'name' => 'محمد',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Pa$$w0rd!'),
            'email_verified_at' => now(),
            'phone_number' => '+1 234 5678',
        ]);
        $admin->assignRole($role);
        $role->givePermissionTo(Permission::all());
    }
}
