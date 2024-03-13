<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//MODEL
use App\Models\Post;

class PostController extends Controller
{
    public function index(){

         $posts = Post::all();

        return response()->json([
            'success' => true,
            'results' => $posts,
        ]);
    }
    public function show(string $slug){
        
         $post = Post::where('slug', $slug)->firstOrFail();

    return response()->json([
        'success' => true,
        'result' => $post,
    ]);
    }
}
