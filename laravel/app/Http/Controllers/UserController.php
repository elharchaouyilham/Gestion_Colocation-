<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Membership;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $membership = Membership::with('colocation')
            ->where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        $invitations = Invitation::where('email', $user->email)
            ->where('status', 'pending')
            ->with('colocation')
            ->get();

        $categories = collect();
        $totalSpent = 0;
        $balances = collect();

        if ($membership) {
            $colocationId = $membership->colocation_id;

            $categories = Category::where('colocation_id', $colocationId)->get();

            $totalSpent = Expense::where('colocation_id', $colocationId)->sum('amount');

            $members = Membership::where('colocation_id', $colocationId)
                ->whereNull('left_at')
                ->get();

            $memberCount = $members->count();

            $fairShare = $memberCount > 0 ? ($totalSpent / $memberCount) : 0;

            $balances = $members->map(function ($m) use ($colocationId, $fairShare) {
                $userPaid = Expense::where('colocation_id', $colocationId)
                    ->where('payer_id', $m->user_id)
                    ->sum('amount');

                return [
                    'user_id' => $m->user_id,
                    'balance' => $userPaid - $fairShare
                ];
            });
        }

        return view('user.dashboard', compact(
            'membership',
            'invitations',
            'categories',
            'totalSpent',
            'balances'
        ));
    }
}
