<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileSetingsRequest;
use App\Models\User;
use App\Helpers\ImageUpload;
use Toastr;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }
    public function update(ProfileSetingsRequest $request)
    {
        auth()->user()->update($request->except('image'));

        $request['slug'] = str_slug($request->name);

        $image = new ImageUpload();
        $image->add($request, auth()->user(), 'profile');

        Toastr::success('Profile Susscessfully Updated :)', 'Succsess');

        return redirect()->back();

    }
}
