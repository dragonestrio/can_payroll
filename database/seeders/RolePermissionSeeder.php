<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::factory(1)->create();
        $role = [
            // 'superadmin',
            'admin',
            // 'owner', 'karyawan',
            // 'user',
        ];

        foreach ($role as $key => $value) {
            $role_add = Role::create([
                'name'          => $value,
                'guard_name'    => 'web',
            ]);
            $permission_add = Permission::create([
                'name'          => $value,
                'guard_name'    => 'web',
            ]);
            $role_add->givePermissionTo($value);
            $permission_add->assignRole($value);
        }
    }
}
