<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SectorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StatController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\ContactSubmissionController;
use App\Http\Controllers\Api\AboutPageController;
use App\Http\Controllers\Api\AboutPageAdminController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\WhyChooseController;
use App\Http\Controllers\Api\SiteSettingController;
use App\Http\Controllers\Api\HeroSlideController;
use App\Http\Controllers\Api\NewsArticleController;
use App\Http\Controllers\Api\EventController;

// ─── Auth ───
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ─── Health Check ───
Route::get('/health', fn() => ['status' => 'ok']);

// ─── Sectors ───
Route::prefix('sectors')->group(function () {
    Route::get('/', [SectorController::class, 'index']);
    Route::get('/{slug}', [SectorController::class, 'show']);
});

// ─── Categories ───
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/{slug}', [CategoryController::class, 'show']);
});

// ─── Products ───
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/featured', [ProductController::class, 'featured']);
    Route::get('/{slug}', [ProductController::class, 'show']);
});

// ─── Companies ───
Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/featured', [CompanyController::class, 'featured']);
    Route::get('/{slug}', [CompanyController::class, 'show']);
    Route::get('/{slug}/profile', [CompanyController::class, 'profile']);
    Route::get('/{slug}/stats', [StatController::class, 'byCompany']);
});

// ─── Stats ───
Route::get('/stats', [StatController::class, 'index']);

// ─── Hero Slides - Home page ───
Route::get('/hero-slides', [HeroSlideController::class, 'index']);

// ─── Projects ───
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/featured', [ProjectController::class, 'featured']);
    Route::get('/{slug}', [ProjectController::class, 'show']);
});

// ─── Public Contact ───
Route::get('/contact-info', [ContactInfoController::class, 'index']);
Route::post('/contact-submissions', [ContactSubmissionController::class, 'store']);

// ─── About Page (Public) ───
Route::prefix('about')->group(function () {
    Route::get('/', [AboutPageController::class, 'index']);
    Route::get('/settings', [AboutPageController::class, 'settings']);
    Route::get('/story', [AboutPageController::class, 'story']);
    Route::get('/stats', [AboutPageController::class, 'stats']);
    Route::get('/carousel', [AboutPageController::class, 'carousel']);
    Route::get('/mission', [AboutPageController::class, 'mission']);
    Route::get('/vision', [AboutPageController::class, 'vision']);
    Route::get('/core-values', [AboutPageController::class, 'coreValues']);
});

// ─── Admin (Protected) ───
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {

    // Contact Info
    Route::get('/contact-info', [ContactInfoController::class, 'show']);
    Route::post('/contact-info', [ContactInfoController::class, 'storeOrUpdate']);

    // Contact Submissions
    Route::prefix('contact-submissions')->group(function () {
        Route::get('/', [ContactSubmissionController::class, 'index']);
        Route::get('/stats', [ContactSubmissionController::class, 'stats']);
        Route::get('/{id}', [ContactSubmissionController::class, 'show']);
        Route::put('/{id}', [ContactSubmissionController::class, 'update']);
        Route::delete('/{id}', [ContactSubmissionController::class, 'destroy']);
    });

    // About Page Admin
    // Route::prefix('about')->group(function () {
    //     Route::post('/clear-cache', [AboutPageAdminController::class, 'clearCache']);
    //     Route::put('/settings', [AboutPageAdminController::class, 'updateSettings']);
    //     Route::put('/story', [AboutPageAdminController::class, 'updateStory']);
    //     Route::put('/story/highlights', [AboutPageAdminController::class, 'updateStoryHighlights']);
    //     Route::post('/carousel', [AboutPageAdminController::class, 'storeCarouselSlide']);
    //     Route::put('/carousel/{id}', [AboutPageAdminController::class, 'updateCarouselSlide']);
    //     Route::delete('/carousel/{id}', [AboutPageAdminController::class, 'destroyCarouselSlide']);
    //     Route::put('/mission', [AboutPageAdminController::class, 'updateMission']);
    //     Route::put('/mission/points', [AboutPageAdminController::class, 'updateMissionPoints']);
    //     Route::put('/vision', [AboutPageAdminController::class, 'updateVision']);
    //     Route::put('/vision/pillars', [AboutPageAdminController::class, 'updateVisionPillars']);
    //     Route::put('/core-values', [AboutPageAdminController::class, 'updateCoreValues']);
    //     Route::delete('/core-values/{id}', [AboutPageAdminController::class, 'destroyCoreValue']);
    // });

    Route::prefix('about')->group(function () {
        Route::get('/', [AboutPageController::class, 'index']);
        Route::get('/settings', [AboutPageController::class, 'settings']);
        Route::get('/story', [AboutPageController::class, 'story']);
        Route::get('/stats', [AboutPageController::class, 'stats']);
        Route::get('/carousel', [AboutPageController::class, 'carousel']);
        Route::get('/mission', [AboutPageController::class, 'mission']);
        Route::get('/vision', [AboutPageController::class, 'vision']);
        Route::get('/core-values', [AboutPageController::class, 'coreValues']);
    });

});

// Route::get('/about', [AboutController::class, 'index']);
Route::get('/homepage-about', [AboutController::class, 'index']);
Route::get('/why-choose', [WhyChooseController::class, 'index']);
Route::get('/site-settings', [SiteSettingController::class, 'index']);

// ─── News ───
Route::prefix('news')->group(function () {
    Route::get('/', [NewsArticleController::class, 'index']);
    Route::get('/{slug}', [NewsArticleController::class, 'show']);
});

// ─── Events ───
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/{slug}', [EventController::class, 'show']);
});
