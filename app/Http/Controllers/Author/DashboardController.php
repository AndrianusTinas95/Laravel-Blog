<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts();
        $popular_posts = $user->posts()
            ->withCount('comments')
            ->withCount('favorite_to_users')
            ->orderBy('view', 'desc')
            ->orderBy('favorite_to_users_count')
            ->take(5)->get();
        $total_pending_posts = $user->posts()->where('is_approved', false)->count();
        $all_views = $user->posts()->sum('view');
        return view('author.dashboard', compact('user', 'posts', 'popular_posts', 'total_pending_posts', 'all_views'));
    }
}
