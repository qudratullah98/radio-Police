<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                [
                'name' => 'Users',
                'guard_name' => 'web',
            ],[
                'name' => 'Create Users',
                'guard_name' => 'web',
            ],[
                'name' => 'Edit Users',
                'guard_name' => 'web',
            ]
        ];
        foreach ($data as $key => $value) {
            Permission::create($value);
        }
    }
}
