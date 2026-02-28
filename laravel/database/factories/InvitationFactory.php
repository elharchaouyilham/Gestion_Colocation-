<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Invitation;
use App\Models\Colocation;

class InvitationFactory extends Factory
{
    protected $model = Invitation::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->safeEmail(),
            'token' => Str::uuid(),
            'status' => 'pending',
            'colocation_id' => Colocation::factory(),
        ];
    }
}