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

// ─── Projects ───
Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/featured', [ProjectController::class, 'featured']);
    Route::get('/{slug}', [ProjectController::class, 'show']);
});

// ─── Public Contact ───
Route::get('/contact-info', [ContactInfoController::class, 'index']);
Route::post('/contact-submissions', [ContactSubmissionController::class, 'store']);

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
});


// Projects
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

// Companies (for filter)
Route::get('/companies/for-filter', [ProjectController::class, 'companiesForFilter']);