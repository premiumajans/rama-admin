<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:admin', 'as' => 'backend.'], function () {
//General
    Route::get('change-language/{lang}', [App\Http\Controllers\Backend\LanguageController::class, 'switchLang'])->name('switchLang');
    Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('index');
    Route::get('dashboard', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');
    Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('report');
    Route::get('give-permission', [App\Http\Controllers\Backend\PermissionController::class, 'givePermission'])->name('givePermission');
    Route::get('give-permission-to-user/{user}', [App\Http\Controllers\Backend\PermissionController::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::get('contact-us/{id}/read', [App\Http\Controllers\Backend\ContactController::class, 'readContact'])->name('readContact');
    Route::post('give-permission-to-user-update', [App\Http\Controllers\Backend\PermissionController::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    Route::get('slider/{id}/change-order', [App\Http\Controllers\Backend\SliderController::class, 'sliderOrder'])->name('sliderOrder');
    Route::get('newsletter/history', [App\Http\Controllers\Backend\NewsletterController::class, 'newsletterHistory'])->name('newsletterHistory');
    Route::post('change-category', [App\Http\Controllers\Backend\ContentController::class, 'changeCategory'])->name('changeCategory');
    Route::post('change-alt-category', [App\Http\Controllers\Backend\ContentController::class, 'changeAltCategory'])->name('changeAltCategory');
    Route::get('gallery/{id}/photos', [App\Http\Controllers\Backend\GalleryController::class, 'photos'])->name('gallery.photos');
    Route::get('gallery/photos/{id}/delete', [App\Http\Controllers\Backend\GalleryController::class, 'photosDelete'])->name('gallery.photos.delete');
    Route::post('gallery/{id}/photos/store', [App\Http\Controllers\Backend\GalleryController::class, 'photosStore'])->name('gallery.photos.store');
    Route::group(['name' => 'status'], function () {
Route::get('blog/{id}/change-status',[App\Http\Controllers\Backend\BlogController::class,'status'])->name('blogStatus');

Route::get('portfolio/{id}/change-status',[App\Http\Controllers\Backend\PortfolioController::class,'status'])->name('portfolioStatus');

Route::get('service/{id}/change-status',[App\Http\Controllers\Backend\ServiceController::class,'status'])->name('serviceStatus');

Route::get('media/{id}/change-status',[App\Http\Controllers\Backend\MediaController::class,'status'])->name('mediaStatus');

Route::get('catalog/{id}/change-status',[App\Http\Controllers\Backend\CatalogController::class,'status'])->name('catalogStatus');

Route::get('blog/{id}/change-status',[App\Http\Controllers\Backend\BlogController::class,'status'])->name('blogStatus');

Route::get('portfolio/{id}/change-status',[App\Http\Controllers\Backend\PortfolioController::class,'status'])->name('portfolioStatus');

Route::get('product/{id}/change-status',[App\Http\Controllers\Backend\ProductController::class,'status'])->name('productStatus');

Route::get('service/{id}/change-status',[App\Http\Controllers\Backend\ServiceController::class,'status'])->name('serviceStatus');

Route::get('media/{id}/change-status',[App\Http\Controllers\Backend\MediaController::class,'status'])->name('mediaStatus');

Route::get('catalog/{id}/change-status',[App\Http\Controllers\Backend\CatalogController::class,'status'])->name('catalogStatus');

        Route::get('mail/{id}/change-status', [App\Http\Controllers\Backend\MailController::class, 'status'])->name('mailStatus');
        Route::get('alt-categories/{id}/change-status', [App\Http\Controllers\Backend\AltCategoryController::class, 'status'])->name('alt-categoriesStatus');
        Route::get('sub-categories/{id}/change-status', [App\Http\Controllers\Backend\SuApp\Http\Controllers\Backend\CategoryControllerController::class, 'status'])->name('sub-categoriesStatus');
        Route::get('video/{id}/change-status', [App\Http\Controllers\Backend\VideoController::class, 'status'])->name('videoStatus');
        Route::get('writer/{id}/change-status', [App\Http\Controllers\Backend\WriterController::class, 'status'])->name('writerStatus');
        Route::get('gallery/{id}/change-status', [App\Http\Controllers\Backend\GalleryController::class, 'status'])->name('galleryStatus');
        Route::get('about/{id}/change-status', [App\Http\Controllers\Backend\AboutController::class, 'status'])->name('aboutStatus');
        Route::get('content/{id}/change-status', [App\Http\Controllers\Backend\ContentController::class, 'status'])->name('contentStatus');
        Route::get('/site-language/{id}/change-status', [App\Http\Controllers\Backend\SiteLanguageController::class, 'siteLanStatus'])->name('siteLanStatus');
        Route::get('/categories/{id}/change-status', [App\Http\Controllers\Backend\CategoryController::class, 'categoryStatus'])->name('categoryStatus');
        Route::get('/settings/{id}/change-status', [App\Http\Controllers\Backend\SettingController::class, 'settingStatus'])->name('settingsStatus');
        Route::get('/seo/{id}/change-status', [App\Http\Controllers\Backend\MetaController::class, 'seoStatus'])->name('seoStatus');
        Route::get('/slider/{id}/change-status', [App\Http\Controllers\Backend\SliderController::class, 'sliderStatus'])->name('sliderStatus');
        Route::get('/useful-link/{id}/change-status', [App\Http\Controllers\Backend\UsefulLinkController::class, 'status'])->name('statusLink');
    });
    Route::group(['name' => 'delete'], function () {
Route::get('blog/{id}/delete',[App\Http\Controllers\Backend\BlogController::class,'delete'])->name('blogDelete');

Route::get('portfolio/{id}/delete',[App\Http\Controllers\Backend\PortfolioController::class,'delete'])->name('portfolioDelete');

Route::get('service/{id}/delete',[App\Http\Controllers\Backend\ServiceController::class,'delete'])->name('serviceDelete');

Route::get('media/{id}/delete',[App\Http\Controllers\Backend\MediaController::class,'delete'])->name('mediaDelete');

Route::get('catalog/{id}/delete',[App\Http\Controllers\Backend\CatalogController::class,'delete'])->name('catalogDelete');

Route::get('blog/{id}/delete',[App\Http\Controllers\Backend\BlogController::class,'delete'])->name('blogDelete');

Route::get('portfolio/{id}/delete',[App\Http\Controllers\Backend\PortfolioController::class,'delete'])->name('portfolioDelete');

Route::get('product/{id}/delete',[App\Http\Controllers\Backend\ProductController::class,'delete'])->name('productDelete');

Route::get('service/{id}/delete',[App\Http\Controllers\Backend\ServiceController::class,'delete'])->name('serviceDelete');

Route::get('media/{id}/delete',[App\Http\Controllers\Backend\MediaController::class,'delete'])->name('mediaDelete');

Route::get('catalog/{id}/delete',[App\Http\Controllers\Backend\CatalogController::class,'delete'])->name('catalogDelete');

        Route::get('mail/{id}/delete', [App\Http\Controllers\Backend\MailController::class, 'delete'])->name('mailDelete');
        Route::get('video/{id}/delete', [App\Http\Controllers\Backend\VideoController::class, 'delete'])->name('videoDelete');
        Route::get('writer/{id}/delete', [App\Http\Controllers\Backend\WriterController::class, 'delete'])->name('writerDelete');
        Route::get('gallery/{id}/delete', [App\Http\Controllers\Backend\GalleryController::class, 'delete'])->name('galleryDelete');
        Route::get('about/{id}/delete', [App\Http\Controllers\Backend\AboutController::class, 'delete'])->name('aboutDelete');
        Route::get('content/{id}/delete', [App\Http\Controllers\Backend\ContentController::class, 'delete'])->name('contentDelete');
        Route::get('content/photo/{id}/delete', [App\Http\Controllers\Backend\ContentController::class, 'deletePhoto'])->name('contentPhotoDelete');
        Route::get('/site-languages/{id}/delete', [App\Http\Controllers\Backend\SiteLanguageController::class, 'delSiteLang'])->name('delSiteLang');

        Route::get('/categories/{id}/delete', [App\Http\Controllers\Backend\CategoryController::class, 'delCategory'])->name('delCategory');
        Route::get('/alt-categories/{id}/delete', [App\Http\Controllers\Backend\AltCategoryController::class, 'delete'])->name('alt-categoriesDelete');
        Route::get('/sub-categories/{id}/delete', [App\Http\Controllers\Backend\SubCategoryController::class, 'delete'])->name('sub-categoriesDelete');

        Route::get('/contact-us/{id}/delete', [App\Http\Controllers\Backend\ContactController::class, 'delContactUS'])->name('delContactUS');
        Route::get('/settings/{id}/delete', [App\Http\Controllers\Backend\SettingController::class, 'delSetting'])->name('settingsDelete');
        Route::get('/users/{id}/delete', [App\Http\Controllers\Backend\AdminController::class, 'delAdmin'])->name('delAdmin');
        Route::get('/seo/{id}/delete', [App\Http\Controllers\Backend\MetaController::class, 'delSeo'])->name('delSeo');
        Route::get('/slider/{id}/delete', [App\Http\Controllers\Backend\SliderController::class, 'delSlider'])->name('sliderDelete');
        Route::get('/report/{id}/delete', [App\Http\Controllers\Backend\ReportController::class, 'delReport'])->name('delReport');
        Route::get('/report/clean-all', [App\Http\Controllers\Backend\ReportController::class, 'cleanAllReport'])->name('cleanAllReport');
        Route::get('/permission/{id}/delete', [App\Http\Controllers\Backend\PermissionController::class, 'delPermission'])->name('delPermission');
        Route::get('/newsletter/{id}/delete', [App\Http\Controllers\Backend\NewsletterController::class, 'delNewsletter'])->name('delNewsletter');
        Route::get('/useful-links/{id}/delete', [\App\Http\Controllers\Backend\UsefulLinkController::class, 'delete'])->name('delLinks');
    });
    Route::group(['name' => 'resource'], function () {
Route::resource('/blog',App\Http\Controllers\Backend\BlogController::class);

Route::resource('/portfolio',App\Http\Controllers\Backend\PortfolioController::class);

Route::resource('/service',App\Http\Controllers\Backend\ServiceController::class);

Route::resource('/media',App\Http\Controllers\Backend\MediaController::class);

Route::resource('/catalog',App\Http\Controllers\Backend\CatalogController::class);

Route::resource('/blog',App\Http\Controllers\Backend\BlogController::class);

Route::resource('/portfolio',App\Http\Controllers\Backend\PortfolioController::class);

Route::resource('/product',App\Http\Controllers\Backend\ProductController::class);

Route::resource('/service',App\Http\Controllers\Backend\ServiceController::class);

Route::resource('/media',App\Http\Controllers\Backend\MediaController::class);

Route::resource('/catalog',App\Http\Controllers\Backend\CatalogController::class);

        Route::resource('/mail', App\Http\Controllers\Backend\MailController::class);
        Route::resource('/alt-categories', App\Http\Controllers\Backend\AltCategoryController::class);
        Route::resource('/sub-categories', App\Http\Controllers\Backend\SubCategoryController::class);
        Route::resource('/video', App\Http\Controllers\Backend\VideoController::class);
        Route::resource('/writer', App\Http\Controllers\Backend\WriterController::class);
        Route::resource('/gallery', App\Http\Controllers\Backend\GalleryController::class);
        Route::resource('/content', App\Http\Controllers\Backend\ContentController::class);
        Route::resource('/categories', App\Http\Controllers\Backend\CategoryController::class);
        Route::resource('/site-languages', App\Http\Controllers\Backend\SiteLanguageController::class);
        Route::resource('/contact-us', App\Http\Controllers\Backend\ContactController::class);
        Route::resource('/about', App\Http\Controllers\Backend\AboutController::class);
        Route::resource('/settings', App\Http\Controllers\Backend\SettingController::class);
        Route::resource('/users', App\Http\Controllers\Backend\AdminController::class);
        Route::resource('/informations', App\Http\Controllers\Backend\InformationController::class);
        Route::resource('/seo', App\Http\Controllers\Backend\MetaController::class);
        Route::resource('/newsletter', App\Http\Controllers\Backend\NewsletterController::class);
        Route::resource('/slider', App\Http\Controllers\Backend\SliderController::class);
        Route::resource('/permissions', App\Http\Controllers\Backend\PermissionController::class);
        Route::resource('/useful-links', App\Http\Controllers\Backend\UsefulLinkController::class);
    });
});
Route::fallback(function () {
    return view('backend.errors.404');
});
Route::group(['name' => 'auth'], function () {
    Route::get('/login', [App\Http\Controllers\Backend\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('loginAdmin', [App\Http\Controllers\Backend\AuthController::class, 'login'])->name('loginPost');
    Route::post('logout', [App\Http\Controllers\Backend\AuthController::class, 'logout'])->name('logout');
});
