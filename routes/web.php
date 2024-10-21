<?php
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/inscription', [RegistrationController::class, 'create'])->name('registration.create');
Route::post('/inscription', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/success', function () {
    return view('success');
})->name('success');
