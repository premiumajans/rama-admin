<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class BackendLanguage
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('blang')) {
            App::setLocale(Session::get('blang'));
        }
        return $next($request);
    }
}
