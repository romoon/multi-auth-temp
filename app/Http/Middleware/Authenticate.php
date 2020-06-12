<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login'); // route('login')
        }
        if (Auth::guard("user")->check()) {
            return redirect()->guest(url('/login'));
        } elseif (Auth::guard("admin")->check()) {
            return redirect()->guest(url('/admin/login'));
        } else {
            return redirect()->guest(url('/index'));
        }
    }
}
