<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $expense = $this->route('expense');

        return Membership::where('user_id', Auth::id())
            ->where('colocation_id', $expense->colocation_id)
            ->whereNull('left_at')
            ->exists();
    }

    public function rules(): array
    {
        return [];
    }
}
