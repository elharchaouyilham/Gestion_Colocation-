<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Colocation;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Loyer',
                'Courses',
                'Internet',
                'Electricité'
            ]),
            'colocation_id' => Colocation::factory(),
        ];
    }
}
