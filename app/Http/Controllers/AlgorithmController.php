<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Algorithm;
use Illuminate\Http\Request;

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
}
