<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json(['status' => '404']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['name' => 'api'], function () {
    Route::get('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::get('/product', [App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/portfolio/{id}', [App\Http\Controllers\Api\PortfolioController::class, 'show']);
    Route::get('/portfolio', [App\Http\Controllers\Api\PortfolioController::class, 'index']);
    Route::get('/service/{id}', [App\Http\Controllers\Api\ServiceController::class, 'show']);
    Route::get('/service', [App\Http\Controllers\Api\ServiceController::class, 'index']);
    Route::get('/media/{id}', [App\Http\Controllers\Api\MediaController::class, 'show']);
    Route::get('/media', [App\Http\Controllers\Api\MediaController::class, 'index']);
    Route::get('/catalog/{id}', [App\Http\Controllers\Api\CatalogController::class, 'show']);
    Route::get('/catalog', [App\Http\Controllers\Api\CatalogController::class, 'index']);
    Route::get('/blog', [App\Http\Controllers\Api\BlogController::class, 'index']);
    Route::get('/blog/{id}', [App\Http\Controllers\Api\BlogController::class, 'show']);
    Route::get('/settings', function () {
        return App\Models\Setting::all();
    });
    Route::post('contact', [App\Http\Controllers\Api\ContactController::class, 'store']);
    Route::get('categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
    Route::get('categories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show']);
    Route::get('useful-links', [App\Http\Controllers\Api\UsefulLinkController::class, 'index']);
    Route::get('useful-links/{id}', [App\Http\Controllers\Api\UsefulLinkController::class, 'show']);
    Route::get('settings', [App\Http\Controllers\Api\SettingsController::class, 'index']);
    Route::get('settings/{name}', [App\Http\Controllers\Api\SettingsController::class, 'show']);
    Route::get('about', [App\Http\Controllers\Api\AboutController::class, 'index']);
    Route::get('about/{id}', [App\Http\Controllers\Api\AboutController::class, 'show']);;
    Route::get('slider', [App\Http\Controllers\Api\SliderController::class, 'index']);
    Route::get('slider/{id}', [App\Http\Controllers\Api\SliderController::class, 'show']);
    Route::get('content', [App\Http\Controllers\Api\ContentController::class, 'index']);
    Route::get('content/{id}', [App\Http\Controllers\Api\ContentController::class, 'show']);
    Route::get('content-news', [App\Http\Controllers\Api\ContentController::class, 'news']);
    Route::post('content-mail', [App\Http\Controllers\Api\MailController::class, 'index']);
    Route::get('content/{cat_id}/{alt_id}', [App\Http\Controllers\Api\ContentController::class, 'altCat']);
    Route::get('content/{cat_id}/{alt_id}/{sub_id}', [App\Http\Controllers\Api\ContentController::class, 'subAltCat']);
    Route::get('/search/{keyword}', [App\Http\Controllers\Api\SearchController::class, 'search']);
});
