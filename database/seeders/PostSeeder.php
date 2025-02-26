<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i<=20; $i++){
            Post::create([
                'title'=>fake()->title(),
                'content'=>fake()->text(),
                'user_id'=>rand(2, 20),
                'category_id'=>rand(1, 10), // Category::all()
                'region_id'=>rand(1, 6),
                'view_count'=>rand(1, 10000),
                'price'=>fake()->randomFloat(2, 100, 1000),
                'image'=>fake()->imageUrl(640, 480),
            ]);
        }
    }
}
