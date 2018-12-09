<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::published()->approved()->latest()->get()->take(9);
        return view('welcome', compact('categories', 'posts'));
    }

    public function dashboard()
    {

        if (auth()->check() && auth()->user()->role->id == 1) {
            return redirect()->route('admin.dashboard');
        } else if (auth()->check() && auth()->user()->role->id == 2) {
            return redirect()->route('author.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
