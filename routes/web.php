<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\LoginClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VariationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OrderController;

//test
Route::get('/getClient', [PagesController::class, 'index']);
use App\Http\Controllers\UpdateStatusController;

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

//Brand
Route::get('/all-brand', [BrandController::class, 'all_brand']);
Route::get('/delete-brand/{brand_id}', [BrandController::class, 'delete_brand']);
Route::get('/edit-brand/{brand_id}', [BrandController::class, 'edit_brand']);
Route::post('/add-brand', [BrandController::class, 'add_brand']);
Route::get('/show-brand', [BrandController::class, 'show_brand']);
Route::post('/update-brand/{brand_id}', [BrandController::class, 'update_brand']);

//Category
Route::get('/all-category', [CategoryController::class, 'all_category']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete_category']);
Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category']);
Route::post('/add-category', [CategoryController::class, 'add_category']);
Route::get('/show-category', [CategoryController::class, 'show_category']);
Route::post('/update-category/{category_id}', [CategoryController::class, 'update_category']);


//User
Route::get('/all-user', [UserController::class, 'all_user']);
Route::get('/delete-user/{user_id}', [UserController::class, 'delete_user']);
Route::get('/edit-user/{user_id}', [UserController::class, 'edit_user']);
Route::get('/all-user/{user_id}', [UserController::class, 'all_user_by_role']);
Route::post('/add-user', [UserController::class, 'add_user']);
Route::post('/update-user/{user_id}', [UserController::class, 'update_user']);

//Role
Route::get('/show-role', [RoleController::class, 'show_role']);
// Variation
Route::resource('/variations', VariationsController::class);

// gọi hàm index trong PagesController
Route::get('/', [PagesController::class, 'index']);
Route::get('/manager-order',[OrderController::class, 'manager_order']);
Route::get('/view-order/{OrderID}',[OrderController::class, 'view_order']);
Route::post('/update/{OrderID}',[OrderController::class, 'updatestatus']);


//client login
Route::post('/loginClient', [LoginClientController::class, 'index']);
