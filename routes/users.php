<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\customAuth;
use App\Http\Middleware\isAdmin;

Route::get('/{userId}', [UsersController::class, 'getUserByUserId'])->name('user.byUserId');