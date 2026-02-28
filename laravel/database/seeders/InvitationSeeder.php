<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invitation;
use App\Models\Colocation;
use Illuminate\Support\Str;

class InvitationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Colocation::all() as $colocation) {
            for ($i = 0; $i < 3; $i++) {
                Invitation::create([
                    'email' => fake()->safeEmail(),
                    'token' => Str::uuid(),
                    'status' => 'pending',
                    'colocation_id' => $colocation->id,
                ]);
            }
        }
    }
}