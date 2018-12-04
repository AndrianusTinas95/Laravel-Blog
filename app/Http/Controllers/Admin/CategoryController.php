<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
// use Image;
// use Storage;
use Brian2694\Toastr\Facades\Toastr;
use App\Helpers\ImageUpload;

class CategoryController extends Controller
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

        $this->image->add($request, $category, 'category');

        Toastr::success('Category Created ', 'Success');

        return redirect()->route('admin.category.index');

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

        $this->image->add($request, $category, 'category');

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
        $this->image->delete('category/slider', $category->image);
        $this->image->delete('category', $category->image);

        $category->delete();

        Toastr::success('Category Deleted', 'Success');

        return redirect()->route('admin.category.index');
    }
}
