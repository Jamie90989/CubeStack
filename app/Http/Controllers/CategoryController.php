<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::whereNull('parent_category_id')->get();

    return view('createCategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_category_id' => 'nullable|exists:categories,id',
        ]);

        $parent = Category::find($request->parent_category_id);

        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'parent_category_id' => $request->parent_category_id,
            'category_level' => $parent ? $parent->category_level + 1 : 1,
            'is_standard' => false,
        ]);

        return redirect()->route('algorithms.index')
            ->with('success', 'Category added successfully!');
    }
}
