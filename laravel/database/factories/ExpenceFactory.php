<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Expense;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Colocation;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'date' => now(),
            'payer_id' => User::factory(),
            'category_id' => Categorie::factory(),
            'colocation_id' => Colocation::factory(),
        ];
    }
}