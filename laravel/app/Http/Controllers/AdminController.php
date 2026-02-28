<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $activeUsersCount = User::where('status', 'active')->count();
        $bannedUsersCount = User::where('status', 'ban')->count();

        $totalColocations = Colocation::count();
        $activeColocations = Colocation::where('status', 'active')->count();
        $cancelledColocations = Colocation::where('status', 'cancelled')->count();

        $totalExpenses = Expense::count();
        $users = User::all();

        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsersCount',
            'bannedUsersCount',
            'totalColocations',
            'activeColocations',
            'cancelledColocations',
            'totalExpenses',
            'users'
        ));
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);

       
        if (Auth::id() === $user->id) {
            return back();
        }
        if ($user->role_id === 1) {
            return back();
        }
        if ($user->status === 'ban') {
            return back();
        }

        $user->status = 'ban';
        $user->save();

        return back();
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);


        if ($user->role_id === 1) {
            return back();
        }

        if ($user->status === 'active') {
            return back();
        }

        $user->status = 'active';
        $user->save();

        return back();
    }
}