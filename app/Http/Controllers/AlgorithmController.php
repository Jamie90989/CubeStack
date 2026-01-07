<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Algorithm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AlgorithmController extends Controller
{
    public function index(Request $request)
    {
        $query = Algorithm::query();

        // Filter by category if provided
        if ($request->has('category')) {
            $categoryId = $request->category;
            $query->where('category_id', $categoryId);
        }

        // Only include standard algorithms if the user is logged in and does NOT want to hide them
        if (Auth::check()) {
            $user = Auth::user();

            if (!$user->hideStandardAlgs) {
                // Include user's algorithms OR standard algorithms
                $query->where(function ($q) use ($user) {
                    $q->where('user_id', $user->id)
                        ->orWhere('is_standard', true);
                });
            } else {
                // Only include user's own algorithms
                $query->where('user_id', $user->id);
            }
        }

        $algorithms = $query->get();

        // categories for navigation are in AppServiceProvider.php
        

        return view('algorithms', compact('algorithms'));
    }

    public function create()
    {
        if (Auth::check()) {
            $categories = Category::with('children')->where(function ($q) {
                $q->where('user_id', Auth::id())
                    ->orWhere('is_standard', true);
            })->whereNull('parent_category_id')
                ->get();
        } else {
            $categories = Category::with('children')
                ->where('is_standard', true)
                ->whereNull('parent_category_id')
                ->get();
        }

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

    public function edit(Algorithm $algorithm)
    {
        // Only allow the owner or admin to edit
        if ($algorithm->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        // Get categories for the dropdown (same logic as create)
        if (Auth::check()) {
            $categories = Category::with('children')->where(function ($q) {
                $q->where('user_id', Auth::id())
                    ->orWhere('is_standard', true);
            })->whereNull('parent_category_id')
                ->get();
        } else {
            $categories = Category::with('children')->where('is_standard', true)
                ->whereNull('parent_category_id')
                ->get();
        }

        return view('editAlgorithm', compact('algorithm', 'categories'));
    }

    public function update(Request $request, Algorithm $algorithm)
    {
        // Only allow the owner to update
        if ($algorithm->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'algorithm' => 'required|string',
            'description' => 'nullable|string',
            'group' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            // Store new image
            $imagePath = $request->file('image')->store('algorithms', 'public');
            $algorithm->image = $imagePath;
        }

        $algorithm->update([
            'name' => $request->name,
            'algorithm' => $request->algorithm,
            'description' => $request->description,
            'group' => $request->group,
            'category_id' => $request->category_id,
        ]);

        return redirect('/')->with('success', 'Algorithm updated successfully!');
    }

    public function destroy(Algorithm $algorithm)
    {
        // Only allow the owner to delete
        if ($algorithm->user_id !== Auth::id()) {
            abort(403);
        }

        // Delete the image file if exists
        if ($algorithm->image && Storage::disk('public')->exists($algorithm->image)) {
            Storage::disk('public')->delete($algorithm->image);
        }


        $algorithm->delete();

        return redirect('/')->with('success', 'Algorithm deleted successfully!');
    }
}
