<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Entity\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'ndqk',
            'email' => 'ndqk@ndqk.com',
            'password' =>bcrypt('123456'),
            'address' => 'VN',
            'phone' => '0866950199'
        ]);

        $role = Role::create(['name' => 'Customer']);
        $user->assignRole($role->id);
    }
}
