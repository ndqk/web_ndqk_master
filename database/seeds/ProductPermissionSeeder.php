<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class ProductPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisisons = [
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
        ];

        foreach($permisisons as $permisison){
            Permission::create(['name' => $permisison]);
        }
    }
}
