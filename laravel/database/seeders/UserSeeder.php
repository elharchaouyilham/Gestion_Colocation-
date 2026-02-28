<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('title', 'admin')->first();
        $userRole = Role::where('title', 'user')->first();
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'is_admin' => true,
            'role_id' => $adminRole->id,
        ]);

        // Users normaux
        User::factory(8)->create([
            'role_id' => $userRole->id,
        ]);
    }
}