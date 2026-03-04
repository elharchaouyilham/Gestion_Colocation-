<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->exists();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'categorie_id' => 'required|exists:categories,id',
            'date' => 'required|date',
        ];
    }
}
