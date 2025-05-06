<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\ChoicesController;

Route::prefix('v1')->group(function () {
    // STORIES
    Route::get('/stories', [StoriesController::class, 'index']);
    Route::get('/stories/{id}', [StoriesController::class, 'show']);
    Route::post('/stories', [StoriesController::class, 'store']);

    // CHAPTERS
    Route::get('/chapters', [ChaptersController::class, 'index']);
    Route::get('/chapters/{id}', [ChaptersController::class, 'show']);
    Route::post('/chapters', [ChaptersController::class, 'store']);

    // CHOICES
    Route::get('/choices', [ChoicesController::class, 'index']);
    Route::post('/choices', [ChoicesController::class, 'store']);
});
