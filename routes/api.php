<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json(['status' => '404']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/settings', function () {
    return \App\Models\Setting::all();
});
Route::post('contact', [\App\Http\Controllers\Api\ContactController::class, 'store']);

Route::get('categories', [\App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('categories/{id}', [\App\Http\Controllers\Api\CategoryController::class, 'show']);

Route::get('useful-links', [\App\Http\Controllers\Api\UsefulLinkController::class, 'index']);
Route::get('useful-links/{id}', [\App\Http\Controllers\Api\UsefulLinkController::class, 'show']);

Route::get('settings', [\App\Http\Controllers\Api\SettingsController::class, 'index']);
Route::get('settings/{name}', [\App\Http\Controllers\Api\SettingsController::class, 'show']);

Route::get('about', [\App\Http\Controllers\Api\AboutController::class, 'index']);
Route::get('about/{id}', [\App\Http\Controllers\Api\AboutController::class, 'show']);

Route::get('gallery', [\App\Http\Controllers\Api\GalleryController::class, 'index']);
Route::get('gallery/{id}', [\App\Http\Controllers\Api\GalleryController::class, 'show']);

Route::get('slider', [\App\Http\Controllers\Api\SliderController::class, 'index']);
Route::get('slider/{id}', [\App\Http\Controllers\Api\SliderController::class, 'show']);

Route::get('content', [\App\Http\Controllers\Api\ContentController::class, 'index']);
Route::get('content/{id}', [\App\Http\Controllers\Api\ContentController::class, 'show']);
Route::get('content-news', [\App\Http\Controllers\Api\ContentController::class, 'news']);
Route::post('content-mail', [\App\Http\Controllers\Api\MailController::class, 'index']);

Route::get('content/{cat_id}/{alt_id}', [\App\Http\Controllers\Api\ContentController::class, 'altCat']);
Route::get('content/{cat_id}/{alt_id}/{sub_id}', [\App\Http\Controllers\Api\ContentController::class, 'subAltCat']);

Route::get('/search/{keyword}', [\App\Http\Controllers\Api\SearchController::class, 'search']);

Route::get('writer', [\App\Http\Controllers\Api\WriterController::class, 'index']);
Route::get('writer/{id}', [\App\Http\Controllers\Api\WriterController::class, 'show']);

