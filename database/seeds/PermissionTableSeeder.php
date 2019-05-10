<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //////php artisan db:seed --class=PermissionTableSeeder
        $permissions = [
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            /////
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            //
            'realtor-list',
            'realtor-edit',
            'realtor-delete',

            ///
            'unit-list',
            'unit-delete',
            'unit-active',
            /////
            'type-unit-list',
            'type-unit-create',
            'type-unit-edit',
            'type-unit-delete',
            /////
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            /////
            'state-list',
            'state-create',
            'state-edit',
            'state-delete',
            /////
            'report-list',
            'report-delete',
            'report-seen',
            /////
            'settings'

        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
