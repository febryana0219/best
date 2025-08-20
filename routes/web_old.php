<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\SlideShowController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\AboutController;

// Admin routes
Route::prefix('admin')->group(function () {

    // Route login (no auth middleware needed)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Group all routes that need authentication
    Route::middleware('auth:web')->group(function () {
        // Route untuk halaman dashboard setelah login
        Route::get('/', [HomeController::class, 'index'])->name('admin.home');

        // Home page routes
        Route::prefix('homepage')->group(function () {
            Route::get('/slide_show', [SlideShowController::class, 'index'])->name('homepage.slide_show.index');
            Route::get('/slide_show/create', [SlideShowController::class, 'create'])->name('homepage.slide_show.create');
            Route::post('/slide_show', [SlideShowController::class, 'store'])->name('homepage.slide_show.store');
            Route::get('/slide_show/{id}/edit', [SlideShowController::class, 'edit'])->name('homepage.slide_show.edit');
            Route::put('/slide_show/{id}', [SlideShowController::class, 'update'])->name('homepage.slide_show.update');
            Route::get('/slide_show/order', [SlideShowController::class, 'order'])->name('homepage.slide_show.order');
            Route::post('/slide_show/order', [SlideShowController::class, 'updateOrder'])->name('homepage.slide_show.order.update');
            Route::post('/slide_show/{id}/publish', [SlideShowController::class, 'update_publish'])->name('homepage.slide_show.publish');
            Route::delete('/slide_show/{slide_show}', [SlideShowController::class, 'destroy'])->name('homepage.slide_show.destroy');

            Route::get('/banner', [ContentController::class, 'banner'])->name('homepage.banner');
            Route::put('/banner', [ContentController::class, 'banner_update'])->name('homepage.banner.update');

            Route::get('/footer', [ContentController::class, 'footer'])->name('homepage.footer');
            Route::put('/footer', [ContentController::class, 'footer_update'])->name('homepage.footer.update');
        });

        // Catalog routes
        Route::prefix('catalog')->group(function () {
            Route::get('/category/order', [CategoryController::class, 'order'])->name('category.order');
            Route::post('/category/order', [CategoryController::class, 'updateOrder'])->name('category.order.update');
            Route::resource('/category', CategoryController::class);

            Route::prefix('category/{categoryId}/catalog')->name('category.catalog.')->group(function () {
                Route::get('/', [CatalogController::class, 'index'])->name('index');
                Route::get('/create', [CatalogController::class, 'create'])->name('create');
                Route::post('/', [CatalogController::class, 'store'])->name('store');
                Route::get('/{catalog}/edit', [CatalogController::class, 'edit'])->name('edit');
                Route::put('/{catalog}', [CatalogController::class, 'update'])->name('update');
                Route::delete('/{catalog}', [CatalogController::class, 'destroy'])->name('destroy');
            });
        });

        // Static page routes
        Route::prefix('static_page')->group(function () {
            Route::get('/page_header', [StaticPageController::class, 'index'])->name('static_page.page_header');
            Route::get('/page_header/{id}/edit', [StaticPageController::class, 'edit'])->name('static_page.page_header.edit');
            Route::put('/page_header/{id}', [StaticPageController::class, 'update'])->name('static_page.page_header.update');
            Route::post('/page_header/{id}/show_footer', [StaticPageController::class, 'update_show_footer'])->name('static_page.page_header.show_footer');

            Route::get('/about', [AboutController::class, 'index'])->name('static_page.about');
            Route::get('/about/{id}/edit', [AboutController::class, 'edit'])->name('static_page.about.edit');
            Route::put('/about/{id}', [AboutController::class, 'update'])->name('static_page.about.update');
        });

        // Contact routes
        Route::prefix('contact')->group(function () {
            Route::get('/messages', [ContactController::class, 'message_index'])->name('contact.messages');
            Route::get('/address', [ContactController::class, 'address_index'])->name('contact.address');
            Route::get('/address/{id}/edit', [ContactController::class, 'address_edit'])->name('contact.address.edit');
            Route::put('/address/{id}', [ContactController::class, 'address_update'])->name('contact.address.update');
            Route::post('/address/{id}/publish', [ContactController::class, 'address_update_publish'])->name('contact.address.publish');
        });

        // System routes
        Route::prefix('system')->group(function () {
            Route::get('/newsletter', [SystemController::class, 'nnewsletter_index'])->name('system.newsletter');

            Route::get('/social_link/order', [SocialLinkController::class, 'order'])->name('social_link.order');
            Route::post('/social_link/order', [SocialLinkController::class, 'updateOrder'])->name('social_link.order.update');
            Route::post('/social_link/{id}/publish', [SocialLinkController::class, 'update_publish'])->name('social_link.publish');
            Route::resource('/social_link', SocialLinkController::class);

            Route::get('/email', [SystemController::class, 'edit_email'])->name('system.email.edit');
            Route::post('/email/update/{systemName}', [SystemController::class, 'update'])->name('system.email.update');

            Route::get('/ga', [SystemController::class, 'edit_ga'])->name('system.ga.edit');
            Route::post('/ga/update/{systemName}', [SystemController::class, 'update_ga'])->name('system.ga.update');
        });
    });
});

// User route
Route::get('/', function () {
    return view('welcome');
});
