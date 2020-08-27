<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class CatePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisisons = [
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
        ];

        foreach($permisisons as $permisison){
            Permission::create(['name' => $permisison]);
        }
    }
}
