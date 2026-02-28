<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payer;
use App\Models\Colocation;
use App\Models\Membership;

class PayerFactory extends Factory
{
    protected $model = Payer::class;

    public function definition(): array
    {
        $colocation = Colocation::inRandomOrder()->first()
            ?? Colocation::factory()->create();

        $members = Membership::where('colocation_id', $colocation->id)
            ->pluck('user_id');

        if ($members->count() < 2) {
            return [
                'from_user_id' => null,
                'to_user_id' => null,
                'colocation_id' => $colocation->id,
                'montant' => 0,
                'paid_at' => null,
            ];
        }

        $from = $members->random();
        $to = $members->where('!=', $from)->random();

        return [
            'sender_id' => $from,
            'reciever_id' => $to,
            'colocation_id' => $colocation->id,
            'montant' => $this->faker->randomFloat(2, 10, 250),
            'paid_at' => $this->faker->boolean(70) ? now() : null,
        ];
    }

    public function paid()
    {
        return $this->state(fn () => [
            'paid_at' => now(),
        ]);
    }

    public function unpaid()
    {
        return $this->state(fn () => [
            'paid_at' => null,
        ]);
    }
}