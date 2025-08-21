<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminAuthController,
    SystemController,
    EmailController,
    CategoryController,
    CategoryProjectController,
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
    NewsController,
    QualityControlController,
    ProjectImageController,
    QualityControlDetailController,
    QualityControlDetailImageController,
    QualityControlImageRenameController,
    ClientWorkedController,
    BgController
};

use App\Http\Controllers\User\{
    UserHomeController,
    UserContactController,
    UserNewsletterController,
    UserAboutController,
    UserNewsController,
    UserProductController,
    UserProjectController,
    UserCareerController
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

            Route::prefix('client_worked')->name('client_worked.')->group(function () {
                Route::get('/', [ClientWorkedController::class, 'index'])->name('index');
                Route::get('/create', [ClientWorkedController::class, 'create'])->name('create');
                Route::post('/', [ClientWorkedController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [ClientWorkedController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ClientWorkedController::class, 'update'])->name('update');
                Route::get('/order', [ClientWorkedController::class, 'order'])->name('order');
                Route::post('/order', [ClientWorkedController::class, 'updateOrder'])->name('order.update');
                Route::post('/{id}/publish', [ClientWorkedController::class, 'update_publish'])->name('publish');
                Route::delete('/{id}', [ClientWorkedController::class, 'destroy'])->name('destroy');
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

            Route::prefix('news')->name('news.')->group(function () {
                Route::get('/', [NewsController::class, 'index'])->name('index');
                Route::get('/create', [NewsController::class, 'create'])->name('create');
                Route::post('/', [NewsController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [NewsController::class, 'edit'])->name('edit');
                Route::put('/{id}', [NewsController::class, 'update'])->name('update');
                Route::post('/{id}/publish', [NewsController::class, 'update_publish'])->name('publish');
                Route::delete('/{id}', [NewsController::class, 'destroy'])->name('destroy');
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

            Route::prefix('email_career')->name('email_career.')->group(function () {
                Route::get('/', [EmailController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [EmailController::class, 'edit'])->name('edit');
                Route::put('/{id}', [EmailController::class, 'update'])->name('update');
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

            Route::prefix('bg')->name('bg.')->group(function () {
                Route::get('/', [BgController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [BgController::class, 'edit'])->name('edit');
                Route::put('/{id}', [BgController::class, 'update'])->name('update');
            });
        });

        //Quality Control
        Route::prefix('qc')->name('qc.')->group(function () {
            Route::prefix('category')->name('category.')->group(function () {
                Route::get('/', [CategoryProjectController::class, 'index'])->name('index');
                Route::get('/create', [CategoryProjectController::class, 'create'])->name('create');
                Route::post('/', [CategoryProjectController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [CategoryProjectController::class, 'edit'])->name('edit');
                Route::put('/{id}', [CategoryProjectController::class, 'update'])->name('update');
                Route::get('/order', [CategoryProjectController::class, 'order'])->name('order');
                Route::post('/order', [CategoryProjectController::class, 'updateOrder'])->name('order.update');
                Route::delete('/{id}', [CategoryProjectController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('project')->name('project.')->group(function () {
                Route::get('/', [QualityControlController::class, 'index'])->name('index');
                Route::get('/create', [QualityControlController::class, 'create'])->name('create');
                Route::post('/', [QualityControlController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [QualityControlController::class, 'edit'])->name('edit');
                Route::put('/{id}', [QualityControlController::class, 'update'])->name('update');
                Route::post('/{id}/publish', [QualityControlController::class, 'update_publish'])->name('publish');
                Route::delete('/{id}', [QualityControlController::class, 'destroy'])->name('destroy');

                // Detail image new
                Route::prefix('{projectId}/detail_image')->name('detail_image.')->group(function () {
                    Route::get('/', [ProjectImageController::class, 'index'])->name('index');
                    Route::get('/create', [ProjectImageController::class, 'create'])->name('create');
                    Route::post('/', [ProjectImageController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [ProjectImageController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [ProjectImageController::class, 'update'])->name('update');
                    Route::delete('/{id}', [ProjectImageController::class, 'destroy'])->name('destroy');
                });

                // project detail
                Route::prefix('{projectId}/project_detail')->name('project_detail.')->group(function () {
                    Route::get('/', [QualityControlDetailController::class, 'index'])->name('index');
                    Route::get('/create', [QualityControlDetailController::class, 'create'])->name('create');
                    Route::post('/', [QualityControlDetailController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [QualityControlDetailController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [QualityControlDetailController::class, 'update'])->name('update');
                    Route::delete('/{id}', [QualityControlDetailController::class, 'destroy'])->name('destroy');
                });

                // project detail image
                Route::prefix('{projectDetailId}/project_detail_image')->name('project_detail_image.')->group(function () {
                    Route::get('/', [QualityControlDetailImageController::class, 'index'])->name('index');
                    Route::get('/create', [QualityControlDetailImageController::class, 'create'])->name('create');
                    Route::post('/', [QualityControlDetailImageController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [QualityControlDetailImageController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [QualityControlDetailImageController::class, 'update'])->name('update');
                    Route::delete('/{id}', [QualityControlDetailImageController::class, 'destroy'])->name('destroy');
                });
            });
        });

        Route::get('/rename-quality-control-images', [QualityControlImageRenameController::class, 'renameImages'])->name('renameImages.index');

    });
});

// User route
Route::get('/', [UserHomeController::class, 'index'])->name('home.index');
Route::get('/home', [UserHomeController::class, 'index'])->name('home');
Route::get('/contact', [UserContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [UserContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter/subscribe', [UserNewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/news', [UserNewsController::class, 'index'])->name('news.index');
Route::get('/news/show/{id}', [UserNewsController::class, 'show'])->name('news.show');

Route::get('/about', [UserAboutController::class, 'index'])->name('about.index');

// Products routes
Route::get('/category', [UserProductController::class, 'index'])->name('products.index');
Route::get('/category/{category_permalink}', [UserProductController::class, 'index'])->name('products.category');
Route::get('/category/{category_permalink}/{product_permalink}', [UserProductController::class, 'show'])->name('products.show');

// Projects routes
Route::get('/projects/{categoryPermalink?}', [UserProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/category/{categoryPermalink}', [UserProjectController::class, 'index'])->name('projects.category');
Route::get('/projects/detail/{permalink}', [UserProjectController::class, 'detail'])->name('projects.detail');
Route::post('/projects/auth', [UserProjectController::class, '_auth'])->name('projects.auth');
Route::get('/projects/show/{permalink}', [UserProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/show/details/{id}', [UserProjectController::class, 'showDetails'])->name('projects.show.details');
Route::get('/projects/print/{encryptedId}', [UserProjectController::class, 'printPDF'])->name('projects.print');

// Career routes
Route::get('/career', [UserCareerController::class, 'index'])->name('career.index');
Route::post('/career', [UserCareerController::class, 'store'])->name('career.store');

