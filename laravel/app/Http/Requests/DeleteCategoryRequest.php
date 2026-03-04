<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        $category = $this->route('category');

        $membership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $category->colocation_id)
            ->whereNull('left_at')
            ->first();

        return $membership && $membership->role === 'owner';
    }

    public function rules(): array
    {
        return [];
    }
}
