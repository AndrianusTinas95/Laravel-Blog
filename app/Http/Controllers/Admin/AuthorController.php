<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::authors()
            ->withCount('posts')
            ->withCount('favorite_posts')
            ->withCount('comments')
            ->get();

        return view('admin.authors', compact('authors'));
    }
    public function destroy(User $author)
    {

        if ($author->role_id == 2) {
            $author->delete();

            toastr()->success('Author Successlly deleted', 'Success');
            return redirect()->back();

        } else {
            abort(403);
        }
    }
}
