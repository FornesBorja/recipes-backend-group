<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    require __DIR__.'/auth.php';
});

Route::prefix('recipes')->group(function () {
    require __DIR__.'/recipes.php';
});

Route::prefix('users')->group(function () {
    require __DIR__.'/users.php';
});