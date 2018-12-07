<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function add($post)
    {

        if (auth()->user()->favorite_posts()->where('post_id', $post)->count() == 0) {
            auth()->user()->favorite_posts()->attach($post);
            toastr()->success('Post Successfully to added to your favorite list :)', 'Success');
        } else {
            auth()->user()->favorite_posts()->detach($post);
            toastr()->success('Post Successfully to removed to your favorite list :)', 'Success');
        }
        return redirect()->back();

    }
}
