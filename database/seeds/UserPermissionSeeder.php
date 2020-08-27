<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            'user-list',
            'user-edit',
            'user-create',
            'user-delete'
        ];

        foreach($permission as $data){
            Permission::create(['name' => $data]);
        }
    }
}
