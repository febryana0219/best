<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminAuthController,
    SystemController,
    CategoryController,
    ProductController,
    ProductImageController,
    ProductProjectController,
    ContactController,
    ContentController,
    SocialLinkController,
    AdministratorController,
    CatalogController,
    SlideShowController,
    StaticPageController,
    AboutController,
    DewPointCalculatorController,
    DewPointCalculatorRequestorController,
};

use App\Http\Controllers\User\{
    UserHomeController,
    UserContactController,
    UserDewPointCalculatorController
};

// Admin Route
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // Authentication
    Route::get('/login', [AdminAuthController::class, 'index'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('auth:web')->group(function () {
        // Home Page
        Route::prefix('homepage')->name('homepage.')->group(function () {
            Route::prefix('slide_show')->name('slide_show.')->group(function () {
                Route::get('/', [SlideShowController::class, 'index'])->name('index');
                Route::get('/create', [SlideShowController::class, 'create'])->name('create');
                Route::post('/', [SlideShowController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [SlideShowController::class, 'edit'])->name('edit');
                Route::put('/{id}', [SlideShowController::class, 'update'])->name('update');
                Route::get('/order', [SlideShowController::class, 'order'])->name('order');
                Route::post('/order', [SlideShowController::class, 'updateOrder'])->name('order.update');
                Route::post('/{id}/publish', [SlideShowController::class, 'update_publish'])->name('publish');
                Route::delete('/{id}', [SlideShowController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('banner')->name('banner.')->group(function () {
                Route::get('/', [ContentController::class, 'banner'])->name('index');
                Route::put('/', [ContentController::class, 'banner_update'])->name('update');
            });

            Route::prefix('footer')->name('footer.')->group(function () {
                Route::get('/', [ContentController::class, 'footer'])->name('index');
                Route::put('/', [ContentController::class, 'footer_update'])->name('update');
            });

        });


        // Catalog
        Route::prefix('catalog')->name('catalog.')->group(function () {
            Route::prefix('category')->name('category.')->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('index');
                Route::get('/create', [CategoryController::class, 'create'])->name('create');
                Route::post('/', [CategoryController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
                Route::put('/{id}', [CategoryController::class, 'update'])->name('update');
                Route::get('/order', [CategoryController::class, 'order'])->name('order');
                Route::post('/order', [CategoryController::class, 'updateOrder'])->name('order.update');
                Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');

                Route::prefix('{categoryId}/catalog')->name('catalog.')->group(function () {
                    Route::get('/', [CatalogController::class, 'index'])->name('index');
                    Route::get('/create', [CatalogController::class, 'create'])->name('create');
                    Route::post('/', [CatalogController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [CatalogController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [CatalogController::class, 'update'])->name('update');
                    Route::delete('/{id}', [CatalogController::class, 'destroy'])->name('destroy');
                });
            });

            Route::prefix('product')->name('product.')->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/', [ProductController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ProductController::class, 'update'])->name('update');
                Route::post('/{id}/publish', [ProductController::class, 'update_publish'])->name('publish');
                Route::get('/order', [ProductController::class, 'order'])->name('order');
                Route::post('/order', [ProductController::class, 'updateOrder'])->name('order.update');
                Route::delete('/{id}', [ProductController::class, 'destroy'])->name('destroy');

                Route::prefix('product_image')->name('product_image.')->group(function () {
                    Route::post('/{id}/default', [ProductImageController::class, 'set_default'])->name('default');
                    Route::post('/{id}/publish', [ProductImageController::class, 'publish'])->name('publish');
                    Route::delete('/{id}', [ProductImageController::class, 'destroy'])->name('destroy');
                });

                Route::prefix('{productId}/project')->name('project.')->group(function () {
                    Route::get('/', [ProductProjectController::class, 'index'])->name('index');
                    Route::get('/create', [ProductProjectController::class, 'create'])->name('create');
                    Route::post('/', [ProductProjectController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [ProductProjectController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [ProductProjectController::class, 'update'])->name('update');
                    Route::delete('/{id}', [ProductProjectController::class, 'destroy'])->name('destroy');
                });
            });
        });

        // Static Page Routes
        Route::prefix('static_page')->name('static_page.')->group(function () {
            Route::prefix('page_header')->name('page_header.')->group(function () {
                Route::get('/', [StaticPageController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [StaticPageController::class, 'edit'])->name('edit');
                Route::put('/{id}', [StaticPageController::class, 'update'])->name('update');
                Route::post('/{id}/show_footer', [StaticPageController::class, 'update_show_footer'])->name('update_show_footer');
            });

            Route::prefix('about')->name('about.')->group(function () {
                Route::get('/', [AboutController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [AboutController::class, 'edit'])->name('edit');
                Route::put('/{id}', [AboutController::class, 'update'])->name('update');
            });
        });


        // Contact
        Route::prefix('contact')->name('contact.')->group(function () {
            Route::get('/messages', [ContactController::class, 'message_index'])->name('messages.index');

            // Contact Address Routes
            Route::prefix('address')->name('address.')->group(function () {
                Route::get('/', [ContactController::class, 'address_index'])->name('index');
                Route::get('/{id}/edit', [ContactController::class, 'address_edit'])->name('edit');
                Route::put('/{id}', [ContactController::class, 'address_update'])->name('update');
                Route::post('/{id}/publish', [ContactController::class, 'address_update_publish'])->name('publish');
            });

            Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
                Route::get('/', [ContactController::class, 'whatsapp'])->name('index');
                Route::put('/', [ContactController::class, 'whatsapp_update'])->name('update');
            });
        });


        // System
        Route::prefix('system')->name('system.')->group(function () {
            Route::get('/newsletter', [SystemController::class, 'newsletter_index'])->name('newsletter.index');

            Route::prefix('social_link')->name('social_link.')->group(function () {
                Route::get('/', [SocialLinkController::class, 'index'])->name('index');
                Route::get('/create', [SocialLinkController::class, 'create'])->name('create');
                Route::post('/', [SocialLinkController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [SocialLinkController::class, 'edit'])->name('edit');
                Route::put('/{id}', [SocialLinkController::class, 'update'])->name('update');
                Route::get('/order', [SocialLinkController::class, 'order'])->name('order');
                Route::post('/order', [SocialLinkController::class, 'updateOrder'])->name('order.update');
                Route::post('/{id}/publish', [SocialLinkController::class, 'update_publish'])->name('publish');
                Route::delete('/{id}', [SocialLinkController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('seo')->name('seo.')->group(function () {
                Route::get('/', [ContentController::class, 'seo'])->name('edit');
                Route::put('/update', [ContentController::class, 'seo_update'])->name('update');
            });

            Route::prefix('administrator')->name('administrator.')->group(function () {
                Route::get('/', [AdministratorController::class, 'index'])->name('index');
                Route::get('/create', [AdministratorController::class, 'create'])->name('create');
                Route::post('/', [AdministratorController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [AdministratorController::class, 'edit'])->name('edit');
                Route::put('/{id}', [AdministratorController::class, 'update'])->name('update');
                Route::post('/{id}/active', [AdministratorController::class, 'update_active'])->name('active');
                Route::delete('/{id}', [AdministratorController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('email')->name('email.')->group(function () {
                Route::get('/', [SystemController::class, 'edit_email'])->name('edit');
                Route::post('/{systemName}/update', [SystemController::class, 'update'])->name('update');
            });

            Route::prefix('phone')->name('phone.')->group(function () {
                Route::get('/', [SystemController::class, 'edit_phone'])->name('edit');
                Route::post('/{systemName}/update', [SystemController::class, 'update'])->name('update');
            });

            Route::prefix('address')->name('address.')->group(function () {
                Route::get('/', [SystemController::class, 'edit_address'])->name('edit');
                Route::post('/{systemName}/update', [SystemController::class, 'update'])->name('update');
            });

            Route::prefix('ga')->name('ga.')->group(function () {
                Route::get('/', [SystemController::class, 'edit_ga'])->name('edit');
                Route::post('/{systemName}/update', [SystemController::class, 'update'])->name('update');
            });
        });

        // Thecnical
        Route::prefix('technical')->name('technical.')->group(function () {
            Route::prefix('dew_point_calculator')->name('dew_point_calculator.')->group(function () {
                Route::get('/', [DewPointCalculatorController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [DewPointCalculatorController::class, 'edit'])->name('edit');
                Route::put('/{id}', [DewPointCalculatorController::class, 'update'])->name('update');
            });

            Route::get('/dew_point_requestor', [DewPointCalculatorRequestorController::class, 'index'])->name('dew_point_requestor.index');
        });
    });
});

// User route
Route::get('/', [UserHomeController::class, 'index'])->name('user.home.index');
Route::get('/contact', [UserContactController::class, 'index'])->name('user.contact.index');
Route::post('/contact', [UserContactController::class, 'store'])->name('user.contact.store');

// Route::get('/dewpoint-calculator', [UserDewPointCalculatorController::class, 'index'])->name('user.dewpoint.index');
// Route::post('dewpoint-calculator', [UserDewPointCalculatorController::class, 'index'])->name('user.dewpoint.post');

// Technical specifications routes
Route::any('/dewpoint-calculator', [UserDewPointCalculatorController::class, 'index'])->name('user.dewpoint.index');
Route::any('/dewpoint-calculator/auth', [UserDewPointCalculatorController::class, '_auth'])->name('user.dewpoint.auth');
Route::any('/dewpoint-calculator/min-pu-thickness-calculation-by-param', [UserDewPointCalculatorController::class, 'min_pu_thickness_calculation_by_param'])->name('user.dewpoint.min_pu_thickness_calculation_by_param');
