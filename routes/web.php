<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LoginController;

// gọi hàm index trong PagesController
Route::get('/index', [PagesController::class, 'index']);

Route::get('/pages/login', [LoginController::class, 'login']);
