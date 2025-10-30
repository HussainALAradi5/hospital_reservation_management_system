<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('countries/sync', [CountryController::class, 'sync'])->name('countries.sync');

Route::resource('countries', CountryController::class);