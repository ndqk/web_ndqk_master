<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Entity\User;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' =>bcrypt('123456'),
            'address' => 'VN',
            'phone' => '12345670209'
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permission = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permission);

        $user->assignRole('Admin');
    }
}
