<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mujtaba Omari',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$/iQ3qjHGkLNSkmC5WQrRle7AfteytkrRq5FEl6Qhqlox3WBmcni3.',
            //12345678
            'remember_token' => Str::random(10),
            'department_id' => 1,
        ]);

        $role = Role::create(['name' => 'Admin']);
        $user->assignRole($role->id);
        $permissions = [];
        $p = Permission::get('id')->toArray();
        foreach ($p as $key => $value) {
            $permissions[$key] = $value['id'];
        }
        $role->syncPermissions($permissions);
    }
}