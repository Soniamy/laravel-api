<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Post;
use App\Models\Category;

// Helpers
use Illuminate\Support\Str;

// Helpers
use Illuminate\Support\Facades\Schema;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Post::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i = 0; $i < 10; $i++) {
            $title = fake()->sentence();
        
            $slug = Str::slug($title);

            $randomCategory = Category::inRandomOrder()->first();

            $post = Post::create([
                'title' => $title,
                'slug' => $slug,
                'content' => fake()->paragraph(),
                'category_id' => $randomCategory->id,
            ]);
        }
    }
}