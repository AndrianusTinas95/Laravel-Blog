<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\Admin\PostRequest;
use Brian2694\Toastr\Facades\Toastr;
use ImageUpload;

class PostController extends Controller
{
    public $image;

    public function __construct()
    {
        $this->image = new ImageUpload();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $request['author'] = auth()->user()->id;
        $request['slug'] = str_slug($request->title);
        $request['is_approved'] = true;

        if (isset($request->status)) {
            $request['status'] = true;
        } else {
            $request['status'] = false;
        }

        $post = Post::create($request->except('image'));

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $this->image->add($request, $post, 'post');


        Toastr::success('Post Saved', 'Succses');

        return redirect()->route('admin.post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $request['author'] = auth()->user()->id;
        $request['slug'] = str_slug($request->title);
        $request['is_approved'] = true;

        if (isset($request->status)) {
            $request['status'] = true;
        } else {
            $request['status'] = false;
        }

        $post->update($request->except('image'));

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        $this->image->add($request, $post, 'post');


        Toastr::success('Post Updated', 'Succses');

        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->image->delete('post', $post->image);
        $this->image->delete('post/slider', $post->image);

        $post->delete();

        Toastr::success('Post Deleted :) ', 'Success');

        return redirect()->route('admin.post.index');
    }

    public function pending()
    {

        $posts = Post::where('is_approved', false)->latest()->get();
        return view('admin.post.pending', compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == false) {
            $post->is_approved = true;
            $post->save();

            Toastr::success('Post Successfully Approved :) ', 'Success');
        } else {
            Toastr::info('This Post is alredy approved ', 'Info');

        }
        return redirect()->back();
    }
}
