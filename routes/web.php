<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;

Route::get('/', [PublicController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/grid', [AdminController::class, 'gridView']);
    Route::get('/export', [AdminController::class, 'export']);
    Route::post('/content', [AdminController::class, 'store']);
    Route::patch('/content/{content}', [AdminController::class, 'update']);
});
