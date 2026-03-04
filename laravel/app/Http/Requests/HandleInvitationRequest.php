<?php

namespace App\Http\Requests;

use App\Models\Invitation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class HandleInvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $invitation = Invitation::find($this->route('id'));

        return $invitation &&
            $invitation->status === 'pending' &&
            $invitation->email === Auth::user()->email;
    }

    public function rules(): array
    {
        return [];
    }
}
