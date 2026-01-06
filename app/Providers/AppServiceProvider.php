<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.layout', function ($view) {
            $categories = Category::with('children')
                ->whereNull('parent_category_id')
                ->orderBy('name')
                ->get();

            $view->with('navCategories', $categories);
        });

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $navCategories = Category::with('children')
                    ->where(function ($q) {
                        $q->where('user_id', Auth::id())
                            ->orWhere('is_standard', true);
                    })
                    ->whereNull('parent_category_id')
                    ->get();
            } else {
                $navCategories = Category::with('children')
                    ->where('is_standard', true)
                    ->whereNull('parent_category_id')
                    ->get();
            }

            if (Auth::check()) {
                $categories = Category::with('children')
                    ->where(function ($q) {
                        $q->where('user_id', Auth::id())
                            ->orWhere('is_standard', true);
                    })
                    ->whereNull('parent_category_id')
                    ->get();
            } else {
                // Only standard categories for guests
                $categories = Category::with('children')
                    ->where('is_standard', true)
                    ->whereNull('parent_category_id')
                    ->get();
            }

            $view->with('navCategories', $navCategories);
            
            $view->with('categories', $categories);
        });
    }
}
