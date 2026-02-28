<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\User;
use App\Models\Colocation;

class MembershipSeeder extends Seeder
{
    public function run(): void
    {
        $colocations = Colocation::all();
        $users = User::where('is_admin', false)->get();

        foreach ($colocations as $colocation) {

            // Owner membership
            Membership::create([
                'user_id' => $colocation->owner_id,
                'colocation_id' => $colocation->id,
                'role' => 'owner',
                'joined_at' => now(),
            ]);

            // Ajouter 3 membres aléatoires
            $members = $users->where('id', '!=', $colocation->owner_id)
                             ->random(3);

            foreach ($members as $user) {
                Membership::create([
                    'user_id' => $user->id,
                    'colocation_id' => $colocation->id,
                    'role' => 'member',
                    'joined_at' => now(),
                ]);
            }
        }
    }
}