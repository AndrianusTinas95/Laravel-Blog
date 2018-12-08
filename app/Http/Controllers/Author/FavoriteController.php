<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->favorite_posts()->latest()->get();
        return view('author.favorite', compact('posts'));
    }
}
