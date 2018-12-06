<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|unique:subscribers'
        ]);

        Subscriber::create($request->all());

        Toastr::success('You Successfully added to our subscriber list :) ', 'Success');

        return redirect()->back();

    }
}
