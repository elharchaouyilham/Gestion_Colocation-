<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Categorie;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Colocation::all() as $colocation) {

            $members = Membership::where('colocation_id', $colocation->id)->pluck('user_id');
            $categories = Categorie::where('colocation_id', $colocation->id)->pluck('id');

            for ($i = 0; $i < 8; $i++) {
                Expense::create([
                    'title' => 'Depense ' . $i,
                    'amount' => rand(20, 300),
                    'date' => now(),
                    'payer_id' => $members->random(),
                    'category_id' => $categories->random(),
                    'colocation_id' => $colocation->id,
                ]);
            }
        }
    }
}