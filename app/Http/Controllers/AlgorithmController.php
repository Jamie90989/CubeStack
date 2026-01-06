<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Algorithm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlgorithmController extends Controller
{
    public function index(Request $request)
    {
        $query = Algorithm::query();

        if ($request->has('category')) {
            $categoryId = $request->category;

            // Include algorithms from the selected category
            $query->where('category_id', $categoryId);
        }

        $algorithms = $query->get();

        // Send categories to the view for the dropdown
        $navCategories = Category::with('children')->get();

        return view('algorithms', compact('algorithms', 'navCategories'));
    }

    public function create()
    {
        $categories = Category::all(); // Or $navCategories if you want nested categories
        return view('createAlgorithms', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'algorithm' => 'required|string',
            'description' => 'nullable|string',
            'group' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

     $imagePath = null;

if ($request->hasFile('image')) {
    // Store the file in storage/app/public/algorithms
    $imagePath = $request->file('image')->store('algorithms', 'public');
}

        Algorithm::create([
            'name' => $request->name,
            'algorithm' => $request->algorithm,
            'description' => $request->description,
            'group' => $request->group,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'is_standard' => false,
            'image' => $imagePath,
        ]);

        return redirect()->route('algorithms.index')
            ->with('success', 'Algorithm created successfully!');
    }
}
