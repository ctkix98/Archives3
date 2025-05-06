<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index']);

//To check if the url get an other Chapiter, it will send the user on the page of Chapitre 1
// Route::get('/chapter/{id}', [AppController::class, 'index']);


// Instead of using Sanctum (or something similar) for API authentication,
// we are using the built-in Laravel session authentication system.
require_once __DIR__ . '/api.php';