<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TodoListPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'todo-list', 
            'todo-create', 
            'todo-edit', 
            'todo-delete',
            'todo-detail',
            // 'todo-approve-send',
            // 'todo-approve-list',
            // 'todo-approve-check',
            // 'todo-approve-delete',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
