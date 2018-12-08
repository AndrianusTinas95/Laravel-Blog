<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comments', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        toastr()->success('Comment successfully deleted ', 'Success');
        return redirect()->back();
    }
}
