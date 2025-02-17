<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create roles and assign created permissions
        // this can be done as separate statements

        // $permissions = Permission::pluck('id','id')->all();

        // $role->syncPermissions($permissions);

        $permissions = [
            'ادارة المتاجر',
            'إضافة-متجر',
            'تعديل-متجر',
            'حذف-متجر',
            'عرض-متجر',
            'قبول-طلبات-متجر',
            'إدارة الأقسام',
            'إضافة-قسم',
            'تعديل-قسم',
            'حذف-قسم',
            'عرض-قسم',
            'إدارة المناطق',
            'إضافة-منطقة',
            'تعديل-منطقة',
            'حذف-منطقة',
            'عرض-منطقة',
            'إدارة المستخدمين',
            'إضافة-مستخدم',
            'تعديل-مستخدم',
            'حذف-مستخدم',
            'عرض-مستخدم',
            'إدارة الأدوار',
            'إضافة-دور',
            'تعديل-دور',
            'حذف-دور',
            'عرض-دور',
            'إدارة الموظفين',
            'إضافة-موظف',
            'تعديل-موظف',
            'حذف-موظف',
            'عرض-موظف',
            'إدارة الاعلانات',
            'إضافة-اعلان',
            'تعديل-اعلان',
            'حذف-اعلان',
            'عرض-اعلان',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'admin']);
        }
        $role = Role::create(['name' => 'الأدمن','guard_name'=>'admin']);
        $role->givePermissionTo(Permission::all());
    }
}
