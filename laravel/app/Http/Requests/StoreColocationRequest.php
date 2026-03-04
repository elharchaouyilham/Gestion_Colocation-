<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreColocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->exists();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
