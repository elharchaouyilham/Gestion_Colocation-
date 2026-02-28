<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Colocation;
use App\Models\User;

class ColocationFactory extends Factory
{
    protected $model = Colocation::class;

    public function definition(): array
    {
        return [
            'name' => 'Coloc ' . $this->faker->city(),
            'owner_id' => User::factory(),
            'status' => 'active',
        ];
    }
}