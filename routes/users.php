<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\customAuth;
use App\Http\Middleware\isAdmin;

Route::get('/{userId}', [UsersController::class, 'getUserByUserId'])->name('user.byUserId');
Route::middleware(customAuth::class)->group(function () {
    Route::put('/update', [UsersController::class, 'updateOwnUser'])->name('user.update');
});
Route::middleware(isAdmin::class)->group(function () {
    Route::delete('/delete/{userId}', [UsersController::class, 'deleteUserById'])->name('user.delete');
});