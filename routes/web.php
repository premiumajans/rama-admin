<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Backend Controllers
use App\Http\Controllers\Backend\AuthController as BAuth;
use App\Http\Controllers\Backend\AboutController as BAbout;
use App\Http\Controllers\Backend\CategoryController as BCategory;
use App\Http\Controllers\Backend\ContactController as BContact;
use App\Http\Controllers\Backend\HomeController as BHome;
use App\Http\Controllers\Backend\LanguageController as LChangeLan;
use App\Http\Controllers\Backend\SettingController as BSetting;
use App\Http\Controllers\Backend\SiteLanguageController as BSiteLan;
use App\Http\Controllers\Backend\AdminController as BAdmin;
use App\Http\Controllers\Backend\InformationController as BInformation;
use App\Http\Controllers\Backend\PostController as BPost;
use App\Http\Controllers\Backend\MetaController as BMeta;
use App\Http\Controllers\Backend\NewsletterController as BNewsletter;
use App\Http\Controllers\Backend\ReportController as BReport;
use App\Http\Controllers\Backend\Statistics as BStatistics;
use App\Http\Controllers\Backend\SliderController as BSlider;
use App\Http\Controllers\Backend\PermissionController as BPermission;
use App\Http\Controllers\Backend\OrderController as BOrder;
use App\Http\Controllers\ProductController;

//General
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;
Route::get('/login', function () {
    return view('auth.login');
})->name('loginForm');
Route::post('loginAdmin', [BAuth::class, 'login'])->name('login');
Route::group(['middleware' => 'auth:admin'], function () {
//General
    Route::get('/change-language/{lang}', [LChangeLan::class, 'switchLang'])->name('switchLang');
    Route::get('/', [BHome::class, 'index'])->name('index');
    Route::get('/dashboard', [BHome::class, 'index'])->name('dashboard');
    Route::get('/reports', [BReport::class, 'index'])->name('report');
    Route::get('/give-permission', [BPermission::class, 'givePermission'])->name('givePermission');
    Route::get('/give-permission-to-user/{user}', [BPermission::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::get('/contact-us/{id}/read', [BContact::class, 'readContact'])->name('readContact');
    Route::post('/give-permission-to-user-update', [BPermission::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    Route::get('/posts/pendings', [BPost::class, 'pendingPost'])->name('pendingPost');
    Route::get('/posts/pending/{id}', [BPost::class, 'pendingPostId'])->name('pendingPostId');
    Route::get('/posts/pending-post/{id}', [BPost::class, 'ppost'])->name('ppost');
    Route::get('/posts/aprove/{id}', [BPost::class, 'approvePost'])->name('approvePost');
    Route::get('/slider/{id}/change-order', [BSlider::class, 'sliderOrder'])->name('sliderOrder');
    Route::get('/newsletter/history', [BNewsletter::class, 'newsletterHistory'])->name('newsletterHistory');
    Route::get('/service/{id}/component', [\App\Http\Controllers\Backend\ServiceController::class, 'component'])->name('serviceComponent');
    Route::get('/service/{id}/component/create', [\App\Http\Controllers\Backend\ServiceController::class, 'componentCreate'])->name('serviceCreateComponent');
    Route::post('/service/{id}/component/store', [\App\Http\Controllers\Backend\ServiceController::class, 'storeComponent'])->name('storeComponent');
    Route::get('/service/component/{id}/edit', [\App\Http\Controllers\Backend\ServiceController::class, 'componentEdit'])->name('editComponent');
    Route::post('/service/component/{id}/update', [\App\Http\Controllers\Backend\ServiceController::class, 'updateComponent'])->name('updateComponent');
    Route::get('/service/component/{id}/delete', [\App\Http\Controllers\Backend\ServiceController::class, 'componentDelete'])->name('deleteComponent');
    Route::post('logout', [BAuth::class, 'logout'])->name('logout');
    Route::get('orders', [BOrder::class, 'index'])->name('orders');
    Route::get('order/{id}', [BOrder::class, 'read'])->name('orderRead');

//Statuses
    Route::get('/site-language/{id}/change-status', [BSiteLan::class, 'siteLanStatus'])->name('siteLanStatus');
    Route::get('/categories/{id}/change-status', [BCategory::class, 'categoryStatus'])->name('categoryStatus');
    Route::get('/settings/{id}/change-status', [BSetting::class, 'settingStatus'])->name('settingStatus');
    Route::get('/seo/{id}/change-status', [BMeta::class, 'seoStatus'])->name('seoStatus');
    Route::get('/slider/{id}/change-status', [BSlider::class, 'sliderStatus'])->name('sliderStatus');
    Route::get('/post/{id}/change-status', [BPost::class, 'postStatus'])->name('postStatus');
    Route::get('/products/{id}/change-status', [ProductController::class, 'status'])->name('statusProduct');
    Route::get('/services/{id}/change-status', [\App\Http\Controllers\Backend\ServiceController::class, 'status'])->name('statusService');
//Delete
    Route::get('/site-languages/{id}/delete', [BSiteLan::class, 'delSiteLang'])->name('delSiteLang');
    Route::get('/categories/{id}/delete', [BCategory::class, 'delCategory'])->name('delCategory');
    Route::get('/contact-us/{id}/delete', [BContact::class, 'delContactUS'])->name('delContactUS');
    Route::get('/order/{id}/delete', [BOrder::class, 'delete'])->name('delOrder');
    Route::get('/settings/{id}/delete', [BSetting::class, 'delSetting'])->name('delSetting');
    Route::get('/users/{id}/delete', [BAdmin::class, 'delAdmin'])->name('delAdmin');
    Route::get('/seo/{id}/delete', [BMeta::class, 'delSeo'])->name('delSeo');
    Route::get('/slider/{id}/delete', [BSlider::class, 'delSlider'])->name('delSlider');
    Route::get('/report/{id}/delete', [BReport::class, 'delReport'])->name('delReport');
    Route::get('/report/clean-all', [BReport::class, 'cleanAllReport'])->name('cleanAllReport');
    Route::get('/permission/{id}/delete', [BPermission::class, 'delPermission'])->name('delPermission');
    Route::get('/post/{id}/delete', [BPost::class, 'delPost'])->name('delPost');
    Route::get('/newsletter/{id}/delete', [BNewsletter::class, 'delNewsletter'])->name('delNewsletter');
    Route::get('/products/{id}/delete', [ProductController::class, 'delete'])->name('delProduct');
    Route::get('/services/{id}/delete', [\App\Http\Controllers\Backend\ServiceController::class, 'delete'])->name('delService');
//Resources
    Route::resource('/categories', BCategory::class);
    Route::resource('/site-languages', BSiteLan::class);
    Route::resource('/contact-us', BContact::class);
    Route::resource('/about', BAbout::class);
    Route::resource('/settings', BSetting::class);
    Route::resource('/users', BAdmin::class);
    Route::resource('/my-informations', BInformation::class);
    Route::resource('/posts', BPost::class);
    Route::resource('/seo', BMeta::class);
    Route::resource('/newsletter', BNewsletter::class);
    Route::resource('/statistics', BStatistics::class);
    Route::resource('/slider', BSlider::class);
    Route::resource('/permissions', BPermission::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/services', \App\Http\Controllers\Backend\ServiceController::class);
});
