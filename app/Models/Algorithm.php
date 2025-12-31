<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Algorithm extends Model
{
    use HasFactory;

    // Columns that can be mass-assigned
    protected $fillable = [
        'name',
        'algorithm',
        'description',
        'group',
        'image',
        'category_id',
        'user_id',
        'is_standard',
    ];

    // Relationship: an algorithm belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
