<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Support\Facades\Auth;


class Admin{

    public function handle($request, Closure $next) {
        if(Auth::user() && Auth::check() && Auth::user()->isAdmin()){
            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
