<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/auth/register', [AuthController::class, 'sign_up']);
Route::post('/auth/login', [AuthController::class, 'sign_in']);
Route::post('/auth/logout', [AuthController::class, 'log_out']);        