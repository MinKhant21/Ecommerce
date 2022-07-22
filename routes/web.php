<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\AuthController as ControllersAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Models\ProductAddTransaction;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Web Route
Route::get('/',[PageController::class,'home']);
Route::get('/product/{slug}',[PageController::class,'productDetail']);

Route::group(['middleware' => ['Auth']], function () {
    Route::get('/add-cart/{slug}', [CartController::class,'addtocart']);
    Route::get('/remove-cart/{id}', [CartController::class,'removeCart']);
    Route::get('/cart', [CartController::class,'showCart'] );
    Route::get('/checkout', [CartController::class,'checkOut'] );

    Route::get('/order', [OrderController::class,'all'] );
    Route::get('/order-detail/{id}',[OrderController::class,'orderDetail'] );
    Route::get('profile',[OrderController::class,'editProfile']);
    Route::post('update-password',[OrderController::class,'updatePassword'] );
});

Route::get('/login',[ControllersAuthController::class,'showlogin'])->middleware('RedirectIfAuth');
Route::post('/login',[ControllersAuthController::class,'login'])->middleware('RedirectIfAuth');
Route::get('/register',[ControllersAuthController::class,'showregister'])->middleware('RedirectIfAuth');
Route::post('/register',[ControllersAuthController::class,'register'])->middleware('RedirectIfAuth');

Route::group(['middleware'=>'Auth'],function(){
    Route::get('/add-cart/{slug}',[CartController::class,'addtocart']);
    Route::get('/cart',[CartController::class,'showCart']);
});



Route::group(['middleware'=>'RedirectIfNotAuth'],function(){
    Route::get('/logout',[ControllersAuthController::class,'logout']);
    //review

    Route::post('/product-review',[PageController::class,'makereview']);

});



//Admin Route
Route::get('/admin/login',[AuthController::class,'login']);
Route::post('/admin/login',[AuthController::class,'Postlogin']);
// Route::resource('/admin/supplier',SupplierController::class);
Route::group(['prefix'=>'/admin','namespace'=>'Admin','middleware'=>'IsAdmin'],function(){
   
//    Route::get('/',[ProductController::class,'db']);
    Route::get('/',[AuthController::class,'home']);
    Route::resource('supplier',SupplierController::class);
    //product
    Route::resource('product',ProductController::class);
    Route::get('/create-product-add/{id}',[ProductController::class,'showProductAdd']);
    Route::post('/create-product-add/{id}',[ProductController::class,'postProductAdd']);
    Route::get('/product-transaction',[ProductController::class,'showProductAddTran']);

        // order
    Route::get('/order', [AdminOrderController::class,'order']);
    Route::get('/change-order/{id}',[AdminOrderController::class,'changeOrderStatus']);
});