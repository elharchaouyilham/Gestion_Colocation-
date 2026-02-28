<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Categorie;
use App\Models\Expense;
use App\Models\Invitation;
use App\Models\Payer;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::updateOrCreate(['title' => 'admin']);
        $userRole  = Role::updateOrCreate(['title' => 'user']);

        $adminUser = User::updateOrCreate(
            ['email' => 'admin@mailinator.com'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'role_id' => $adminRole->id,'status' => 'ban']
        );

        $user1 = User::updateOrCreate(
            ['email' => 'user1@mailinator.com'],
            ['name' => 'User One', 'password' => Hash::make('password'), 'role_id' => $userRole->id,'status' => 'ban']
        );

        $user2 = User::updateOrCreate(
            ['email' => 'user2@mailinator.com'],
            ['name' => 'User Two', 'password' => Hash::make('password'), 'role_id' => $userRole->id,'status' => 'ban']
        );

        $colo1 = Colocation::updateOrCreate(['name' => 'Coloc A'], ['owner_id' => $adminUser->id, 'status' => 'active']);
        $colo2 = Colocation::updateOrCreate(['name' => 'Coloc B'], ['owner_id' => $user1->id, 'status' => 'active']);

        Membership::updateOrCreate(['user_id' => $adminUser->id, 'colocation_id' => $colo1->id], ['role' => 'owner', 'joined_at' => now()]);
        Membership::updateOrCreate(['user_id' => $user1->id, 'colocation_id' => $colo1->id], ['role' => 'member', 'joined_at' => now()]);
        Membership::updateOrCreate(['user_id' => $user2->id, 'colocation_id' => $colo1->id], ['role' => 'member', 'joined_at' => now()]);
        Membership::updateOrCreate(['user_id' => $user1->id, 'colocation_id' => $colo2->id], ['role' => 'owner', 'joined_at' => now()]);

        $catFood = Categorie::updateOrCreate(['name' => 'Food', 'colocation_id' => $colo1->id]);
        $catRent = Categorie::updateOrCreate(['name' => 'Rent', 'colocation_id' => $colo1->id]);

        Expense::updateOrCreate(['title' => 'Pizza Night', 'colocation_id' => $colo1->id], ['amount' => 60, 'date' => now()->subDays(3), 'payer_id' => $user1->id, 'categorie_id' => $catFood->id]);
        Expense::updateOrCreate(['title' => 'Monthly Rent', 'colocation_id' => $colo1->id], ['amount' => 1200, 'date' => now()->subDays(10), 'payer_id' => $adminUser->id, 'categorie_id' => $catRent->id]);

        Invitation::updateOrCreate(['email' => 'user2@mailinator.com', 'colocation_id' => $colo2->id], ['token' => bin2hex(random_bytes(16)), 'status' => 'pending']);

        Payer::updateOrCreate(['sender_id' => $user2->id,'reciever_id'=>$user1->id, 'colocation_id' => $colo1->id], ['montant' => 300, 'paid_at' => null]);
    }
}