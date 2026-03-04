<?php

namespace App\Http\Requests;

use App\Models\Membership;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
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
        $membership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        $colocationId = $membership ? $membership->colocation_id : null;

        return [
            'name' => [
                'required',
                'string',
                'max:50',
                "unique:categories,name,NULL,id,colocation_id,{$colocationId}"
            ],
        ];
    }
}
