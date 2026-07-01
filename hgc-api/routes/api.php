<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SectorController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Company routes
Route::prefix('companies')->group(function () {
    // GET /api/companies — List all active companies (grid view)
    Route::get('/', [CompanyController::class, 'index']);

    // GET /api/companies/featured — Featured companies
    Route::get('/featured', [CompanyController::class, 'featured']);

    // GET /api/companies/{slug} — Single company detail
    Route::get('/{slug}', [CompanyController::class, 'show']);

    // GET /api/companies/{slug}/profile — Full company profile
    Route::get('/{slug}/profile', [CompanyController::class, 'profile']);
});

// Sector routes
Route::prefix('sectors')->group(function () {
    Route::get('/', [SectorController::class, 'index']);
    Route::get('/{slug}', [SectorController::class, 'show']);
});


// Health check
Route::get('/health', fn() => ['status' => 'ok']);

// Sectors
Route::get('/sectors', [SectorController::class, 'index']);
Route::get('/sectors/{slug}', [SectorController::class, 'show']);

// Categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);

// Products
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/featured', [ProductController::class, 'featured']);
Route::get('/products/{slug}', [ProductController::class, 'show']);

// Companies
Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/featured', [CompanyController::class, 'featured']);
Route::get('/companies/{slug}', [CompanyController::class, 'show']);
Route::get('/companies/{slug}/profile', [CompanyController::class, 'profile']);
