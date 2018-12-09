<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::published()->approved()->latest()->paginate(6);
        return view('posts', compact('posts'));
    }
    public function details($slug)
    {
        $post = Post::published()->approved()->where('slug', $slug)->first();
        if ($post) {
            $blogKey = 'blog_' . $post->id;
            if (!Session::has($blogKey)) {

                $post->increment('view');
                Session::put($blogKey, 1);
            }
            $randomposts = Post::published()->approved()->get()->random(3);
            return view('post', compact('post', 'randomposts'));
        } else {
            toastr()->error('Post not found ', 'Error');
            return redirect()->back();
        }

    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->published()->approved()->paginate(6);
        return view('category', compact('category', 'posts'));
    }
    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->published()->approved()->paginate(6);
        return view('tag', compact('tag', 'posts'));
    }
}
