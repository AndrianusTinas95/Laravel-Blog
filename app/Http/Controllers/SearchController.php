<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string|min:3|max:32',
        ]);
        $query = $request->search;
        $ins = ['title', 'body'];

        $posts = $this->myAlgoritma($query, $ins);

        toastr()->success($posts->count() . ' Results for ' . $query, 'Success');
        return view('search', compact('posts', 'query'));
    }

    public function myAlgoritma($query, $ins)
    {
        $posts = [];
        $data = $index = 0;
        while ($data <= 0 && $index < count($ins)) {
            if ($data <= 0) {
                $posts = $this->querySearch($query, $ins[$index++]);
                $data = $posts->count();
            } else {
                $index++;
            }
        }
        return $posts;
    }

    public function querySearch($query, $in)
    {
        $posts = Post::where($in, 'like', '%' . $query . '%')->approved()->published()->paginate(9);
        return $posts;
    }
}
