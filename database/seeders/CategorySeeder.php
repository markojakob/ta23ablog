<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->makeChildren(3);

        $categories = Category::all();
        $posts = Post::all();
        foreach($posts as $post) {
            $post->category()->associate($categories->random());
            $post->save();
        }
    }

    public function makeChildren($level, $parentId = null){
        if($level<1) return;

        $categories = Category::factory(rand($level, $level+2))->create(['category_id' => $parentId]);
        foreach($categories as $category) {
            $this->makeChildren($level-1, $category->id);
        }
    }
}
