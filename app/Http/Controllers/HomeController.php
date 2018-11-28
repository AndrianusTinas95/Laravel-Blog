<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->role->id == 1) {
            return redirect()->route('admin.dashboard');
        } else if (auth()->check() && auth()->user()->role->id == 2) {
            return redirect()->route('author.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
