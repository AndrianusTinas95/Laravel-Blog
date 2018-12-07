<?php

namespace App\Http\Controllers\Author;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileSetingsRequest;
use App\Models\User;
use App\Helpers\ImageUpload;
use Toastr;
use App\Http\Requests\PasswordSettingsRequest;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        return view('author.settings');
    }
    public function updateProfile(ProfileSetingsRequest $request)
    {
        auth()->user()->update($request->except('image'));

        $request['slug'] = str_slug($request->name);

        $image = new ImageUpload();
        $image->add($request, auth()->user(), 'profile');

        Toastr::success('Profile Susscessfully Updated :)', 'Succsess');

        return redirect()->back();

    }

    public function updatePassword(PasswordSettingsRequest $request)
    {
        if (Hash::check($request->old_password, auth()->user()->password)) {
            if (!Hash::check($request->password, auth()->user()->password)) {
                auth()->user()->password = bcrypt($request->password);
                auth()->user()->save();

                Toastr::success('Password successfully changed', 'Success');
                auth()->logout();
                return redirect()->back();
            } else {
                Toastr::error('New Password cannot be the same as old password.', 'Error');
                return redirect()->back();
            }

        } else {
            Toastr::error('Current password not match .', 'Error');
            return redirect()->back();
        }
    }
}
