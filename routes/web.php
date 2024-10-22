<?php
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/inscription', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/inscription', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/success', function () {
    return view('success');
})->name('success');

Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/connexion', [LoginController::class, 'login']);
Route::post('/deconnexion', [LoginController::class, 'logout'])->name('logout');