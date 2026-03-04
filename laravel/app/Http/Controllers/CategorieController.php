<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Membership;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function store(StoreCategoryRequest $request)
    {
        $membership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        Category::create([
            'name' => $request->name,
            'colocation_id' => $membership->colocation_id,
        ]);

        return redirect()->back()->with('success', 'New category added to your house!');
    }


    public function destroy(DeleteCategoryRequest $request, Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category removed successfully.');
    }
}
