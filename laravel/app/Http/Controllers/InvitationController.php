<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Models\Invitation;
use App\Models\Membership;
use App\Models\User;
use App\Http\Requests\SendInvitationRequest;
use App\Http\Requests\HandleInvitationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function send(SendInvitationRequest $request)
    {
        $user = Auth::user();
        $membership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        $recipient = User::where('email', $request->email)->first();

        $invitation = Invitation::create([
            'email' => $request->email,
            'colocation_id' => $membership->colocation_id,
            'sender_id' => $user->id,
            'reciever_id' => $recipient->id,
            'status' => 'pending',
        ]);

        Mail::to($request->email)->send(new InvitationMail($invitation));

        return back()->with('success', 'Invitation envoyée.');
    }

    public function accept(HandleInvitationRequest $request, $id)
    {
        $user = Auth::user();
        $invitation = Invitation::findOrFail($id);

        $invitation->update(['status' => 'accepted']);

        Membership::create([
            'user_id' => $user->id,
            'colocation_id' => $invitation->colocation_id,
            'role' => 'member',
            'joined_at' => now(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Invitation acceptée.');
    }

    public function refuse(HandleInvitationRequest $request, $id)
    {
        Invitation::where('id', $id)->update(['status' => 'refused']);

        return back()->with('success', 'Invitation refusée.');
    }
}
