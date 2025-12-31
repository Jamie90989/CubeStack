<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'user_id', 'category_level', 'parent_category_id', 'is_standard'];

    // Relationship: a category has many algorithms
    public function algorithms()
    {
        return $this->hasMany(Algorithm::class);
    }

    // Parent category (for subcategories)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    // Child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    /**
     * Owner of the category (only for user-made categories)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
