<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->post('/change-password', [ChangePasswordController::class, 'changePassword']);

Route::put('/profile', [ProfileController::class, 'updateProfile']);

