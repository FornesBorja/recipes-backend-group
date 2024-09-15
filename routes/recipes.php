<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Middleware\customAuth;
use App\Http\Middleware\isAdmin;

Route::get('/', [RecipesController::class, 'index'])->name('recipes.index');
Route::get('/user/{userId}', [RecipesController::class, 'getRecipeByUserId'])->name('recipes.byUserId');

Route::middleware(customAuth::class)->group(function () {
    Route::post('/create', [RecipesController::class, 'createRecipe']);
    Route::get('/own', [RecipesController::class, 'getOwnRecipes']);
    Route::put('/update/{recipeId}', [RecipesController::class, 'updateOwnRecipe']);
    Route::delete('/delete/{recipeId}', [RecipesController::class, 'deleteOwnRecipe']);
});

Route::middleware(isAdmin::class)->group(function () {
    Route::delete('/delete/{recipeId}', [RecipesController::class, 'deleteRecipeById']);
});