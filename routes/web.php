<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::get('countries/sync', [CountryController::class, 'sync'])->name('countries.sync');

Route::resource('countries', CountryController::class);


Route::resource('medicines', MedicineController::class);


Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('auth.login');

Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('auth.register');

Route::post('/logout', [UserAuthController::class, 'logout'])->name('auth.logout');

Route::get('/profile', [UserAuthController::class, 'profile'])->middleware('auth')->name('profile');