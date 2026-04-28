<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::get('/profile', [UserController::class, 'showProfile']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/delete', [UserController::class, 'deleteAccount']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/profile', [UserController::class, 'updateProfile']);