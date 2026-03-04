<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Http\Requests\StoreColocationRequest;
use App\Http\Requests\LeaveColocationRequest;
use App\Http\Requests\CancelColocationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    public function store(StoreColocationRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $colocation = Colocation::create([
                'name' => $request->name,
                'owner_id' => Auth::id(),
                'status' => 'active',
            ]);

            Membership::create([
                'user_id' => Auth::id(),
                'colocation_id' => $colocation->id,
                'role' => 'owner',
                'joined_at' => now(),
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Colocation créée !');
        });
    }

    public function leave(LeaveColocationRequest $request, Colocation $colocation)
    {
        Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->update(['left_at' => now()]);

        return redirect()->route('user.dashboard')->with('success', 'Vous avez quitté la colocation.');
    }

    public function cancel(CancelColocationRequest $request, Colocation $colocation)
    {
        DB::transaction(function () use ($colocation) {
            $colocation->update(['status' => 'cancelled']);

            Membership::where('colocation_id', $colocation->id)
                ->whereNull('left_at')
                ->update(['left_at' => now()]);
        });

        return redirect()->route('user.dashboard')->with('success', 'Colocation supprimée.');
    }
}
