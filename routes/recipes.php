<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Middleware\customAuth;

Route::get('/', [RecipesController::class, 'index'])->name('recipes.index');
Route::get('/user/{userId}', [RecipesController::class, 'getRecipeByUserId'])->name('recipes.byUserId');

Route::middleware(customAuth::class)->group(function () {
    Route::post('/create', [RecipesController::class, 'createRecipe']);
});