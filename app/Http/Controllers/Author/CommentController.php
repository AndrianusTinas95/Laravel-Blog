<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Post::where('author', auth()->user()->id)->get();
        return view('author.comments', compact('posts'));
    }

    public function destroy(Comment $comment)
    {
        if ($comment->post->user->id == auth()->user()->id) {
            $comment->delete();
            toastr()->success('Comment successfully deleted ', 'Success');
            return redirect()->back();
        } else {
            abort(403);
        }

    }
}
