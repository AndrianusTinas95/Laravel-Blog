<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Image;
use Storage;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $request['slug'] = str_slug($request->name);
        $category = Category::create($request->except('image'));

        $this->addImage($request, $category);

        Toastr::success('Category Created ', 'Success');

        return redirect()->route('admin.category.index');

    }

    public function addImage($request, $category)
    {
        if ($request->image) {
            $imageOldName = $category->image;
            $imageNewName = config('app.name') . '-' . $category->slug . '-' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $this->uploadImage($request, $category, 'category/', $imageNewName, $imageOldName);
            $this->uploadImage($request, $category, 'category/slider/', $imageNewName, $imageOldName);
        }
    }

    public function uploadImage($request, $category, $path, $imageNewName, $imageOldName)
    {
        if ($request->hasFile('image')) {
            // create path
            if (!Storage::disk('public')->exists($path)) {
                Storage::disk('public')->makeDirectory($path);
            }
            //resize image for category or slider category
            if ($path == 'category/') {
                $imageFile = Image::make($request->file('image'))->resize(1600, 400)->save('storage/' . $path . 'template.png');
                $category->image = $imageNewName;
                $category->save();
            } else {
                $imageFile = Image::make($request->file('image'))->resize(500, 300)->save('storage/' . $path . 'template.png');
            }
            $this->deleteImage($path . $imageOldName);

            Storage::disk('public')->put($path . $imageNewName, $imageFile);
        }
    }

    public function deleteImage($image)
    {
        if ($image && ($image != 'category/default.png' || $image != 'category/slider/default.png')) {
            try {
                Storage::disk('public')->delete($image);
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
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $request['slug'] = str_slug($request->name);
        $category->update($request->except('image'));

        $this->addImage($request, $category);

        Toastr::success('Category Updated ', 'Success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->deleteImage('category/slider/' . $category->image);
        $this->deleteImage('category/' . $category->image);

        $category->delete();

        Toastr::success('Category Deleted', 'Success');

        return redirect()->route('admin.category.index');
    }
}
