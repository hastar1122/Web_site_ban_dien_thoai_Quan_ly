<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

// gọi hàm index trong PagesController
Route::get('/', [PagesController::class, 'index']);
