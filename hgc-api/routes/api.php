<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompanyController;

Route::prefix('companies')->group(function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('/featured', [CompanyController::class, 'featured']);
    Route::get('/{slug}', [CompanyController::class, 'show']);
});