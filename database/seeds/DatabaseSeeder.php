<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserPermissionSeeder::class);
        // $this->call(PermissionSeeder::class);
        // $this->call(CatePermissionSeeder::class);
        // $this->call(BannerSeeder::class);
        // $this->call(PostSeeder::class);
        // $this->call(TodoListPermissionSeeder::class);
        $this->call(ProductPermissionSeeder::class);

        // $this->call(UserAdminSeeder::class);
    }
}
