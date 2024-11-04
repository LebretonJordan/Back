<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/inscription', [RegistrationController::class, 'store'])->name('registration.store');

Route::post('/connexion', [LoginController::class, 'login']);
