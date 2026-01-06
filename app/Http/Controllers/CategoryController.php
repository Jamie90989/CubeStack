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

    // Show edit form for selected category
    public function edit(Request $request)
    {
        $categoryId = $request->query('category_id');

        if (!$categoryId) {
            return redirect()->back()->with('error', 'Please select a category to edit.');
        }

        $category = Category::findOrFail($categoryId);

        if ($category->user_id !== Auth::id()) {
            abort(403);
        }

        // Parent categories for dropdown, exclude current category
        $categories = Category::where('user_id', Auth::id())
            ->orWhere('is_standard', true)
            ->whereNull('parent_category_id')
            ->where('id', '!=', $category->id)
            ->with('children')
            ->get();

        return view('editCategory', compact('category', 'categories'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        if ($category->user_id !== Auth::id()) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_category_id' => 'nullable|exists:categories,id',
        ]);

        $parent = Category::find($request->parent_category_id);

        $category->update([
            'name' => $request->name,
            'parent_category_id' => $request->parent_category_id,
            'category_level' => $parent ? $parent->category_level + 1 : 1,
        ]);

        return redirect('/')->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy(Category $category)
    {
        if ($category->user_id !== Auth::id()) abort(403);

        // Optionally: delete algorithms under this category if needed

        $category->delete();

        return redirect('/')->with('success', 'Category deleted successfully!');
    }
}
