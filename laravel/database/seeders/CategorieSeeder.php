<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
use App\Models\Colocation;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Loyer', 'Courses', 'Internet', 'Electricité'];

        foreach (Colocation::all() as $colocation) {
            foreach ($categories as $cat) {
                Categorie::create([
                    'name' => $cat,
                    'colocation_id' => $colocation->id,
                ]);
            }
        }
    }
}