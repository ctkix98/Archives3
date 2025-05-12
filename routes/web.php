<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route racine : chargement de l'app Vue (SPA)
Route::get('/', [AppController::class, 'index']);

// Route protégée qui renvoie l'utilisateur connecté (utile pour le frontend)
Route::middleware('auth')->get('/user', function () {
    return Auth::user();
});

// Authentification via session Laravel
require_once __DIR__ . '/api.php';
require __DIR__ . '/auth.php';

Route::get('/{any}', [AppController::class, 'index'])->where('any', '^(?!api).*$');
