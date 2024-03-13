<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     use HasFactory;

    //Utilizzo di Fillable
     protected $fillable = [
        'title',
        'slug'
    ];
    //Relazione//
     public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
