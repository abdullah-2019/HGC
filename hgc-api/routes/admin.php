<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsArticleController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\About\CarouselSlideController;
use App\Http\Controllers\Admin\MediaBrowserController;

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Companies
    Route::resource('companies', CompanyController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Projects
    Route::resource('projects', ProjectController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // News
    Route::resource('news', NewsArticleController::class)->parameters(['news' => 'newsArticle']);

    // Partners
    Route::resource('partners', PartnerController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Contacts
    Route::get('contacts/submissions', [ContactSubmissionController::class, 'index'])->name('contacts.submissions');
    Route::get('contacts/inquiries', [ContactInquiryController::class, 'index'])->name('contacts.inquiries');

    // Settings
    // Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    // Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');

    // Sectors
    Route::resource('sectors', SectorController::class);

    // About Page
    Route::get('about', [AboutPageController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutPageController::class, 'update'])->name('about.update');

    // Products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::patch('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');

    // site setting
    Route::resource('settings', SiteSettingController::class)
    ->parameters([
        'settings' => 'siteSetting',
    ]);

    // stat
    Route::resource('stats', StatController::class)
        ->only([
            'index',
            'edit',
            'update',
        ]);

    Route::prefix('about')
        ->name('about.')
        ->group(function () {

            Route::resource(
                'carousel',
                CarouselSlideController::class
            );

    });

    // media browser
    Route::get(
        'media-browser',
        [MediaBrowserController::class, 'index']
    )->name('media.browser');

});
