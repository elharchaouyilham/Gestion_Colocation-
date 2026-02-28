<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\Membership;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        $membership = Membership::where('user_id', $user->id)
            ->with('colocation')
            ->first();

        $invitations = Invitation::where('email', $user->email)
            ->where('status', 'pending')
            ->with('colocation')
            ->get();

        return view('user.dashboard', compact('membership', 'invitations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        $alreadyMember = Membership::where('user_id', $user->id)->exists();

        if ($alreadyMember) {
            return back()->with('error', 'Vous êtes déjà dans une colocation.');
        }

        $colocation = Colocation::create([
            'name' => $request->name,
            'status' => 'active',
            'owner_id' => $user->id
        ]);
        Membership::create([
            'user_id' => $user->id,
            'colocation_id' => $colocation->id,
            'role' => 'owner',
            'joined_at' => now()
        ]);

        return back()->with('success', 'Colocation créée. Vous êtes le propriétaire.');
    }

    public function accept($id)
    {
        $user = Auth::user();
        if (Membership::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Vous êtes déjà dans une colocation.');
        }

        $invitation = Invitation::where('id', $id)
            ->where('email', $user->email)
            ->where('status', 'pending')
            ->firstOrFail();

        $invitation->update(['status' => 'accepted']);

        Membership::create([
            'user_id' => $user->id,
            'colocation_id' => $invitation->colocation_id,
            'role' => 'member',
            'joined_at' => now()
        ]);

        return back()->with('success', 'Invitation acceptée.');
    }

    public function refuse($id)
    {
        $invitation = Invitation::where('id', $id)
            ->where('email', Auth::user()->email)
            ->where('status', 'pending')
            ->firstOrFail();

        $invitation->update(['status' => 'refused']);

        return back()->with('success', 'Invitation refusée.');
    }

    public function leave()
    {
        $membership = Membership::where('user_id', Auth::id())->firstOrFail();
        if ($membership->role === 'owner') {
            return back()->with('error', 'Le propriétaire ne peut pas quitter sa colocation.');
        }

        $membership->delete();

        return back()->with('success', 'Vous avez quitté la colocation.');
    }
}