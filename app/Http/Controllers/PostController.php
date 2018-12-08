<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where(['status' => true, 'is_approved' => true])->latest()->paginate(6);
        return view('posts', compact('posts'));
    }
    public function details($slug)
    {
        $post = Post::where(['status' => true, 'is_approved' => true, 'slug' => $slug])->first();
        if ($post) {
            $blogKey = 'blog_' . $post->id;
            if (!Session::has($blogKey)) {

                $post->increment('view');
                Session::put($blogKey, 1);
            }
            $randomposts = Post::where(['status' => true, 'is_approved' => true])->get()->random(3);
            return view('post', compact('post', 'randomposts'));
        } else {
            toastr()->error('Post not found ', 'Error');
            return redirect()->back();
        }

    }
}
