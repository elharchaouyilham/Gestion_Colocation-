<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\User;

class ColocationSeeder extends Seeder
{
    public function run(): void
    {
        $owners = User::where('is_admin', false)->take(2)->get();

        foreach ($owners as $owner) {
            Colocation::factory()->create([
                'owner_id' => $owner->id,
                'status' => 'active'
            ]);
        }
    }
}