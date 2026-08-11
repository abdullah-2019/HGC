<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\NewsArticleController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactSubmissionController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\MediaBrowserController;
use App\Http\Controllers\Admin\About\CarouselSlideController;
use App\Http\Controllers\Admin\About\AboutMissionController;
use App\Http\Controllers\Admin\About\AboutVisionController;
use App\Http\Controllers\Admin\About\AboutCoreValueController;
use App\Http\Controllers\Admin\About\AboutStoryController;
use App\Http\Controllers\Admin\About\AboutStoryHighlightController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SiteVideoController;


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard Portal
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Companies & Entities
    Route::resource('companies', CompanyController::class);
    Route::resource('companies.awards', \App\Http\Controllers\Admin\CompanyAwardController::class)->except(['show']);
    Route::resource('companies.values', \App\Http\Controllers\Admin\CompanyValueController::class)->except(['show']);

    // Products
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::patch('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured'])->name('products.toggle-featured');
    Route::resource('products', ProductController::class);

    // Categories, Sectors, Partners, Testimonials
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('sectors', SectorController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('testimonials', TestimonialController::class);

    // News Articles
    Route::get('/news', [NewsArticleController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsArticleController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsArticleController::class, 'store'])->name('news.store');
    Route::get('/news/{article}/edit', [NewsArticleController::class, 'edit'])->name('news.edit');
    Route::put('/news/{article}', [NewsArticleController::class, 'update'])->name('news.update');
    Route::delete('/news/{article}', [NewsArticleController::class, 'destroy'])->name('news.destroy');
    
    // Events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::resource('videos', SiteVideoController::class)->except(['show'])->names([
        'index' => 'videos.index',
        'create' => 'videos.create',
        'store' => 'videos.store',
        'edit' => 'videos.edit',
        'update' => 'videos.update',
        'destroy' => 'videos.destroy',
    ]);
    
    // Communications & Inbound Portals
    Route::get('contacts/submissions', [ContactSubmissionController::class, 'index'])->name('contacts.submissions');
    Route::get('contacts/inquiries', [ContactInquiryController::class, 'index'])->name('contacts.inquiries');

    // Global Key-Value Site Settings
    Route::resource('settings', SiteSettingController::class)->parameters(['settings' => 'siteSetting']);

    // Metrics & Statistics
    Route::resource('stats', StatController::class)->only(['index', 'edit', 'update']);

    // Media Manager Hub
    Route::get('media-browser', [MediaBrowserController::class, 'index'])->name('media.browser');

    // About Main Landing Config
    Route::get('about', [AboutPageController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutPageController::class, 'update'])->name('about.update');

    // Nested About Layout Entities
    Route::prefix('about')->name('about.')->group(function () {
        Route::resource('carousel', CarouselSlideController::class);
        Route::resource('mission', AboutMissionController::class);
        Route::resource('vision', AboutVisionController::class);
        Route::resource('values', AboutCoreValueController::class);

        // Story (single)
        Route::get('story', [AboutStoryController::class, 'index'])->name('story.index');
        Route::get('story/edit', [AboutStoryController::class, 'edit'])->name('story.edit');
        Route::put('story', [AboutStoryController::class, 'update'])->name('story.update');

        // Story Highlights
        Route::get('story/highlights', [AboutStoryHighlightController::class, 'index'])->name('story.highlights.index');
        Route::get('story/highlights/create', [AboutStoryHighlightController::class, 'create'])->name('story.highlights.create');
        Route::post('story/highlights', [AboutStoryHighlightController::class, 'store'])->name('story.highlights.store');
        Route::get('story/highlights/{highlight}/edit', [AboutStoryHighlightController::class, 'edit'])->name('story.highlights.edit');
        Route::put('story/highlights/{highlight}', [AboutStoryHighlightController::class, 'update'])->name('story.highlights.update');
        Route::delete('story/highlights/{highlight}', [AboutStoryHighlightController::class, 'destroy'])->name('story.highlights.destroy');
    });

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::patch('projects/{project}/toggle-featured', [ProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');
    Route::patch('projects/{project}/toggle-active', [ProjectController::class, 'toggleActive'])->name('projects.toggle-active');
    Route::post('projects/{project}/gallery/delete', [ProjectController::class, 'deleteGalleryImage'])->name('projects.gallery.delete');

    // Hero Slides
    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);

});

