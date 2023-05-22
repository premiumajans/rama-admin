<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class FrontLanguage
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('dil')) {
            App::setLocale(Session::get('dil'));
        }
        return $next($request);
    }
}
