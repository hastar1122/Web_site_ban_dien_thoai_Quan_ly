<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


//admin route
Route::get('/login', [AdminController::class, 'login']);
Route::get('/index', [AdminController::class, 'show_index']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-index', [AdminController::class, 'admin_index']);

//admin register
Route::get('/register', [AdminAccountController::class, 'create']);
Route::post('/register', [AdminAccountController::class, 'store']);
