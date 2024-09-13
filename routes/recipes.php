<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;

Route::get('/', [RecipesController::class, 'index'])->name('recipes.index');
Route::get('/user/{userId}', [RecipesController::class, 'getByUserId'])->name('recipes.byUserId');
