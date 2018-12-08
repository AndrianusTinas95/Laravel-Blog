<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class PostController extends Controller
{
    public function details($slug)
    {
        $post = Post::where(['status' => true, 'is_approved' => true, 'slug' => $slug])->first();
        if ($post) {
            $post->increment('view');
            $post->save();
            $randomposts = Post::where(['status' => true, 'is_approved' => true])->get()->random(3);
            return view('post', compact('post', 'randomposts'));
        } else {
            toastr()->error('Post not found ', 'Error');
            return redirect()->back();
        }

    }
}
