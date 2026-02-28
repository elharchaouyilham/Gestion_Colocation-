<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payer;
use App\Models\Colocation;
use App\Models\Membership;

class PayerSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Colocation::all() as $colocation) {

            $members = Membership::where('colocation_id', $colocation->id)
                ->pluck('user_id');

            if ($members->count() < 2) {
                continue;
            }

            for ($i = 0; $i < 5; $i++) {

                $from = $members->random();
                $to = $members->where('!=', $from)->random();

                Payer::create([
                    'sender_id' => $from,
                    'reciever_id' => $to,
                    'colocation_id' => $colocation->id,
                    'montant' => rand(20, 200),
                    'paid_at' => rand(0, 1) ? now() : null,
                ]);
            }
        }
    }
}