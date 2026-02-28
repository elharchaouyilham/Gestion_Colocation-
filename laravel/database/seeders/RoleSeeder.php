<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::Create(['title' => 'admin']);
        Role::Create(['title' => 'user']);
    }
}