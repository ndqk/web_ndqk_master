<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'banner-list', 
            'banner-create', 
            'banner-edit', 
            'banner-delete',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
