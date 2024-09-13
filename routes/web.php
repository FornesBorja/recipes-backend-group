<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('recipes')->group(function () {
    require __DIR__.'/recipes.php';
});

Route::prefix('auth')->group(function () {
    require __DIR__.'/auth.php';
});