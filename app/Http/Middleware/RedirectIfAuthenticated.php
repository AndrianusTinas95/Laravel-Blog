<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->check() && auth()->user()->role->id == 1) {
            return redirect()->route('admin.dashboard');
        } else if (auth()->check() && auth()->user()->role->id == 2) {
            return redirect()->route('author.dashboard');
        } else {
            return $next($request);
        }

    }
}
