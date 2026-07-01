<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SectorController;

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
