<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment(Request $request, $post)
    {
        $this->validate($request, [
            'comment' => 'required|string'
        ]);

        $request['user_id'] = auth()->user()->id;
        $request['post_id'] = intval($post);
        Comment::create($request->all());

        toastr()->success('Comment Successfully Published :) ', 'Success');
        return redirect()->back();
    }
}
