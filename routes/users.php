<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\customAuth;
use App\Http\Middleware\isAdmin;

Route::middleware('auth:api')->group(function () {
    Route::get('/{userId}', [UsersController::class, 'getUserByUserId'])->name('user.byUserId');
    Route::delete('/{userId}', [UsersController::class, 'deleteUserById'])->name('user.delete');
    Route::put('/{userId}', [UsersController::class, 'updateOwnUser'])->name('user.update');
});