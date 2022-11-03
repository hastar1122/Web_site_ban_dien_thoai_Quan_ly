<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VariationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OrderController;


//admin login
Route::get('/login', [LoginController::class, 'show']);
Route::get('/index', [LoginController::class, 'show_index']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/postLogin', [LoginController::class, 'postLogin']);

//admin register
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

//admin change password
Route::get('/changePassword', [ChangePasswordController::class, 'show']);
Route::post('/changePassword', [ChangePasswordController::class, 'changePassword']);

// Variation
Route::resource('/variations', VariationsController::class);

// gọi hàm index trong PagesController
Route::get('/', [PagesController::class, 'index']);
Route::get('/manager-order',[OrderController::class, 'manager_order']);
Route::get('/view-order/{OrderID}',[OrderController::class, 'view_order']);
