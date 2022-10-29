<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


//admin login
Route::get('/login', [LoginController::class, 'show']);
Route::get('/index', [LoginController::class, 'show_index']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/postLogin', [LoginController::class, 'postLogin']);

//admin register
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
