<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PasswordResetController;

Route::post('user/login',[LoginController::class, 'userLogin']);
Route::post('user/register',[LoginController::class, 'register']);
Route::post('user/reset-password',[PasswordResetController::class, 'passwordReset']);
Route::get('user/password/find/{token}', [PasswordResetController::class,'emailFind']);
Route::post('user/password/reset-confirm', [PasswordResetController::class,'resetConfirm']);

Route::group( ['prefix' => 'user','middleware' => ['auth:user-api','scopes:user'] ],function(){
   // authenticated staff routes here
   Route::post('logout',[LoginController::class, 'logout']);
    Route::get('userDetails',[LoginController::class, 'userDetails']);
    Route::apiResource('addresses',AddressController::class);
    Route::apiResource('carts',CartController::class);
    Route::get('havAnCart/{id}',[CartController::class,'isCart']);
    Route::post('photo/',[LoginController::class,'userUpdate']);
    Route::apiResource('payments',PaymentController::class);


});

    Route::get('banners/',[BannerController::class,'index']);
    Route::get('banners/{banner}',[BannerController::class,'show']);  
    
    Route::post('orders/',[PayController::class,'orders']);

    Route::get('categories/',[CategoryController::class,'index']);
    Route::get('categories/{category}',[CategoryController::class,'show']);     

    Route::get('products/',[ProductController::class,'index']);
    Route::get('products/{product}/',[ProductController::class,'show']);

    Route::get('categories/{category}/products',[CategoryController::class,'productsByCategory']);
