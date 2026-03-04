<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LeaveColocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $colocation = $this->route('colocation');

        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $colocation->id)
            ->whereNull('left_at')
            ->first();

        return $membership && $membership->role !== 'owner';
    }

    public function rules(): array
    {
        return [];
    }
}
