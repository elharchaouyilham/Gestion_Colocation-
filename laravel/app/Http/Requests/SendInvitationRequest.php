<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $membership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        return $membership && $membership->role === 'owner';
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }
}
