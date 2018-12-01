<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Category::class, 2)->create()->each(function ($category) {
        //     $category->posts()->saveMany(factory(Post::class, 10)->create()->each(function ($post) {
        //         $post->tags()->saveMany(factory(Tag::class, 2)->make());
        //     }));
        // });

        factory(Post::class, 10)->create()->each(function ($post) {
            $post->categories()->saveMany(factory(Category::class, rand(1, 3))->make());
            $post->tags()->saveMany(factory(Tag::class, rand(1, 5))->make());
        });

    }
}
