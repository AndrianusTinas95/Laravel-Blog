<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\Admin\PostRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Image;

class PostController extends Controller
{
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
        $this->addImage($request, $post);

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Post Saved', 'Succses');

        return redirect()->route('admin.post.index');

    }

    public function addImage($request, $post)
    {
        if ($request->image) {
            $imageOldName = $post->image;
            $imageNewName = config('app.name') . '-' . $post->slug . '-' . time() . '.' . $request->image->getClientOriginalExtension();
            $this->uploadImage($request, $post, 'post/', $imageNewName, $imageOldName);
            $this->uploadImage($request, $post, 'post/slider/', $imageNewName, $imageOldName);
        }
    }

    public function uploadImage($request, $post, $path, $imageNewName, $imageOldName)
    {
        if ($request->hasFile('image')) {
            // create path
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
            //resize image for post or slider post and sat template image
            if ($path == 'post/') {
                $imageFile = Image::make($request->file('image'))->resize(1600, 1000)->save('storage/' . $path . 'default.png');
                $post->image = $imageNewName;
                $post->save();
            } else {
                $imageFile = Image::make($request->file('image'))->resize(200, 200)->save('storage/' . $path . 'default.png');
            }
            $this->deleteImage($path, $imageOldName);

            Storage::disk('public')->put($path . $imageNewName, $imageFile);
        }
    }

    public function deleteImage($path, $image)
    {
        if ($image != 'default.png') {
            try {
                Storage::disk('public')->delete($path . $image);
            } catch (FileNotFoundException $e) {
                //throw $th;
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->addImage($request, $post);

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

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
        $this->deleteImage('post/', $post->image);
        $this->deleteImage('post/slider/', $post->image);
        $post->delete();

        Toastr::success('Post Deleted :) ', 'Success');

        return redirect()->route('admin.post.index');
    }
}
