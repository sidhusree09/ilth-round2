<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permission for users
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);

        // permissions for courses
        Permission::create(['name' => 'create-course']);
        Permission::create(['name' => 'edit-course']);
        Permission::create(['name' => 'delete-course']);

        //permission for enrollments
        Permission::create(['name' => 'create-enrollment']);
        Permission::create(['name' => 'edit-enrollment']);
        Permission::create(['name' => 'delete-enrollment']);
        
        // user rolles
        $adminRole = Role::create(['name' => 'Admin']);
        $instructorRole = Role::create(['name' => 'Instructor']);
        $studentRole = Role::create(['name' => 'Student']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-course',
            'edit-course',
            'delete-course',
            'create-enrollment',
            'edit-enrollment',
            'delete-enrollment',
        ]);

        $instructorRole->givePermissionTo([
            'create-course',
            'edit-course',
            'delete-course',
            'create-enrollment',
            'edit-enrollment',
            'delete-enrollment',
        ]);
    }
    
    
}
