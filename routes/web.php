<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;

Route::get('/', [PublicController::class, 'index']);
Route::post('/contact', [PublicController::class, 'submitContactForm']);
Route::get('/download-profile/{year}', [PublicController::class, 'downloadPdf']);

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/grid', [AdminController::class, 'gridView']);
    Route::get('/export', [AdminController::class, 'export']);
    Route::post('/content', [AdminController::class, 'store']);
    Route::patch('/content/{content}', [AdminController::class, 'update']);
    Route::delete('/content/{content}', [AdminController::class, 'destroy']);
    Route::delete('/year/{year}', [AdminController::class, 'destroyYear']);
    Route::delete('/inquiry/{inquiry}', [AdminController::class, 'destroyInquiry']);
});
