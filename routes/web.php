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
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\UpdateStatusController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartViewController;
use App\Http\Controllers\ChangeAmountController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\HistoryOrderController;
use App\Http\Controllers\ProductsController;


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

//Category Attribute Product
Route::get('/show-attribute-product-all/{ProductID}', [ProductAttributeController::class, 'show_catogory_product']);
Route::post('/add-attribute-product/{ProductID}', [ProductAttributeController::class, 'update_product_attr']);
Route::get('/delete-attribute-product/{ProductID}', [ProductAttributeController::class, 'delete_product_attr']);
Route::get('/show-table-attr', [ProductAttributeController::class, 'show_table_attr']);

//Role
Route::get('/show-role', [RoleController::class, 'show_role']);
// Variation
Route::resource('/variations', VariationsController::class);

// gọi hàm index trong PagesController
Route::get('/', [PagesController::class, 'index']);
Route::get('/cate/{cate}', [PagesController::class, 'loadAllProductCate'])->name('cateAPI');
Route::get('/manager-order',[OrderController::class, 'manager_order']);
Route::get('/view-order/{OrderID}',[OrderController::class, 'view_order']);
Route::post('/update-order/{OrderID}',[OrderController::class, 'updatestatus']);
Route::get('/info-order/{OrderID}', [OrderController::class, 'info_order']);
Route::get('/list-order', [OrderController::class,'list_order']);


//client login
Route::get('/showClient', [PagesController::class, 'index']);
//client logout
Route::get('/logoutClient', [LoginController::class, 'logoutClient']);

// Product admin
Route::resource('/products', ProductsController::class);
Route::get('/loadProducts', [ProductsController::class, 'loadProducts']);
Route::resource('/products2', ProductsController::class);

// Thuộc tính sản phẩm
Route::resource('/attributes', AttributesController::class);
Route::get('/listAttribute', [AttributesController::class, 'listAttribute']);
Route::post('/update_attribute', [AttributesController::class, 'update']);

// Product customer
Route::get('/list-products', [PagesController::class,'loadAllProduct']);
Route::get('/search-products', [PagesController::class,'searchProduct']);
Route::post('/list-products/filter', [PagesController::class,'filterProduct']);
Route::post('/list-products/filter-for-price-and-brand', [PagesController::class,'filterProductForPriceAndBrand'])->name('filter-for-price-and-brand');
Route::get('/list-products/{cate}', [PagesController::class, 'loadAllProductCate'])->name('cateAPIProduct');
Route::get('/productdetail/{id}', [PagesController::class,'productdetail']);

//Giỏ hàng
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-cart/{rowId}', [CartController::class, 'delete_cart']);
Route::get('/delete-all-cart', [CartController::class, 'delete_all_cart']);
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/view-cart', [CartController::class, 'view_cart']);
Route::post('/buy-product', [CartController::class, 'buy_product']);


Route::resource('/save-cart-view', CartViewController::class);
Route::resource('/change-amount-cart', ChangeAmountController::class);



//order-client
Route::resource('/order-product', ClientOrderController::class);

//get catergory
// Route::get('/category/{CategoryID}', [PagesController::class, 'show']);

//history
Route::get('/view-history/{id}', [HistoryOrderController::class, 'show_history']);
Route::get('/view-history-detail/{id}', [HistoryOrderController::class, 'show_history_detail']);
Route::get('/delete-order/{id}', [HistoryOrderController::class, 'delete_order']);


// API
Route::get('/ajax-for-select/{id}',[PagesController::class,'ajaxAPICateID'])->name('ajax-for-select');
