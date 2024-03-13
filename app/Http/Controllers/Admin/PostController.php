<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models
use App\Models\Post;
use App\Models\Category;
use App\Models\Technology;

// Helpers
use Illuminate\Support\Str;

// Request
use App\Http\Requests\Post\StoreRequest as PostStoreRequest;
use App\Http\Requests\Post\UpdateRequest as PostUpdateRequest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories = Category::all();
       $technologies = Technology::all();

        return view('admin.posts.create', compact('categories','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        $postData = $request->validated();

        $slug = Str::slug($postData['title']);
         $post = Post::create([
            'title' => $postData['title'],
            'slug' => $slug,
            'content' => $postData['content'],
            'category_id' => $postData['category_id'],
        ]);

        if (isset($postData['technologies'])) {
            foreach ($postData['technologies'] as $singleTechnologyId) {
                $post->technologies()->attach($singleTechnologyId);
            }
        }

        return redirect()->route('admin.posts.show', compact('post'));
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
       return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
         $technologies = Technology::all();

        return view('admin.posts.edit', compact('post', 'categories','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
         $postData = $request->validated();

        $slug = Str::slug($postData['title']);
        $post->update([
            'title' => $postData['title'],
            'slug' => $slug,
            'content' => $postData['content'],
            'category_id' => $postData['category_id'],
        ]);
         if (isset($postData['technologies'])) {
            $post->technologies()->sync($postData['technologies']);
        }
        else {
            $post->technologies()->detach();
        }

        return redirect()->route('admin.posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
       $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
