<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Membership;
use App\Models\User;
use App\Models\Colocation;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'colocation_id' => Colocation::factory(),
            'role' => 'member',
            'joined_at' => now(),
            'left_at' => null,
        ];
    }
}
