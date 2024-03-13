<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     use HasFactory;

      protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id'
    ];
    // Relazione One-to-Many con Category
     public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Relazione Many-to-Many con Technology
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
