<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MedicineCompanyController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicineDescriptionController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DescriptionController; // ✅ NEW

Route::get('/', fn() => view('home'))->name('home');

Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('auth.login');

Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('auth.register');

Route::post('/logout', [UserAuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserAuthController::class, 'profile'])->name('profile');

    Route::resource('medicines', MedicineController::class);

    Route::resource('descriptions', DescriptionController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update'
    ]);
});

Route::middleware(['admin'])->group(function () {
    Route::resource('countries', CountryController::class);
    Route::get('countries/sync', [CountryController::class, 'sync'])->name('countries.sync');

    Route::resource('regions', RegionController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('hospitals', HospitalController::class);

    Route::get('rooms/filter', [RoomController::class, 'filter'])->name('rooms.filter');
    Route::resource('rooms', RoomController::class);
    Route::post('rooms/{room}/release', [RoomController::class, 'release'])->name('rooms.release');

    Route::resource('users', UserController::class)->only(['index', 'create', 'store']);
    Route::resource('medicine_companies', MedicineCompanyController::class);
});