<?php

namespace App\Http\Controllers\Author;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\Admin\PostRequest;
use App\Helpers\ImageUpload;
use Brian2694\Toastr\Facades\Toastr;
use Notification;
use App\Models\User;
use App\Notifications\NewAuthorPost;

class PostController extends Controller
{
    public $image;

    public function __construct()
    {
        $this->image = new ImageUpload;
        $this->authorizeResource(Post::class, 'post');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = auth()->user()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
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
        return view('author.post.create', compact('categories', 'tags'));
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
        $request['is_approved'] = false;

        if (isset($request->status)) {
            $request['status'] = true;
        } else {
            $request['status'] = false;
        }

        $post = Post::create($request->except('image'));

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        $this->image->add($request, $post, 'post');

        Notification::send(User::where('role_id', 1)->get(), new NewAuthorPost($post));

        Toastr::success('Post Saved', 'Succses');

        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('author.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all()->pluck('name', 'id');
        $tags = Tag::all()->pluck('name', 'id');
        return view('author.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $request['author'] = auth()->user()->id;
        $request['slug'] = str_slug($request->title);
        $request['is_approved'] = false;

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

        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->image->delete('post', $post->image);
        $this->image->delete('post/slider', $post->image);

        $post->delete();

        Toastr::success('Post Deleted :) ', 'Success');

        return redirect()->route('author.post.index');
    }
}
