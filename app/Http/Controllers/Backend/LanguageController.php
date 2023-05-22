<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    public function switchLang($lang)
    {
        $this->middleware('backendLanguage');
        app()->setLocale($lang);
        session()->put('blang', $lang);
        return redirect()->back();
    }

    public function frontLanguage($dil)
    {
        app()->setLocale($dil);
        session()->put('dil', $dil);
        return redirect()->back();
    }
}
