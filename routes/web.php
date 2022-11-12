<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
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
use App\Http\Controllers\UpdateStatusController;




//admin login
Route::get('/login', [LoginController::class, 'show']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/postLogin', [LoginController::class, 'postLogin']);
Route::get('/index', [LoginController::class, 'show_index'])->middleware('auth.rolesadmin');

//admin register
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

//phan quyen trang
Route::group(['middleware' => 'auth.roles'], function() {

});

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


//Supplier
Route::get('/all-supplier', [SupplierController::class, 'all_supplier']);
Route::get('/delete-supplier/{supplier_id}', [SupplierController::class, 'delete_supplier']);
Route::get('/edit-supplier/{supplier_id}', [SupplierController::class, 'edit_supplier']);
Route::post('/add-supplier', [SupplierController::class, 'add_supplier']);
Route::post('/update-supplier/{supplier_id}', [SupplierController::class, 'update_supplier']);

//Employee
Route::get('/all-employee', [EmployeeController::class, 'all_employee']);
Route::get('/delete-employee/{employee_id}', [EmployeeController::class, 'delete_employee']);
Route::get('/edit-employee/{employee_id}', [EmployeeController::class, 'edit_employee']);
Route::post('/add-employee', [EmployeeController::class, 'add_employee']);
Route::post('/update-employee/{employee_id}', [EmployeeController::class, 'update_employee']);


//Customer
Route::get('/all-customer', [CustomerController::class, 'all_customer']);
Route::get('/delete-customer/{customer_id}', [CustomerController::class, 'delete_customer']);
Route::get('/edit-customer/{customer_id}', [CustomerController::class, 'edit_customer']);
Route::post('/add-customer', [CustomerController::class, 'add_customer']);
Route::post('/update-customer/{customer_id}', [CustomerController::class, 'update_customer']);


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
Route::get('/showClient', [PagesController::class, 'index']);
//client logout
Route::get('/logoutClient', [LoginController::class, 'logoutClient']);
