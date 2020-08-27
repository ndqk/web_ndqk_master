<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'post-list', 
            'post-create', 
            'post-edit', 
            'post-delete',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
