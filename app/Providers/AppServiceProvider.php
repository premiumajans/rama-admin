<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\MetaTag;
use App\Models\Paylasim;
use App\Models\Setting;
use App\Models\SiteLanguage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
//        $currentLanguage = SiteLanguage::where('code', app()->getLocale())->first();
//        $languages = DB::table('site_languages')->get();
//        $tags = MetaTag::where('status', 1)->get();
//        $description = MetaTag::where('attribute_name', 'description')->first();
//        $settings = Setting::where('status', 1)->get();
//        $categories = Category::where('status', 1)->get();
//        view()->share([
//            'currentLanguage' => $currentLanguage,
//            'languages' => $languages,
//            'locale' => app()->getLocale(),
//            'settings' => $settings,
//            'categories' => $categories,
//            'tags' => $tags,
//            'tagDescription' => $description
//        ]);
    }
}
