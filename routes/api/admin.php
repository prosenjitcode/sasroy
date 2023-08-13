<?php

use App\Http\Controllers\PaymentGatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\TermController;

Route::post('admin/login', [LoginController::class, 'adminLogin']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin-api', 'scopes:admin']], function () {
    // authenticated staff routes here 
    //Route::get('/dashboard', [LoginController::class, 'adminDashboard']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/users', [LoginController::class, 'index']);
    
    Route::apiResource('/products', ProductController::class);
    Route::post('/product/{product}', [ProductController::class, 'updateProduct']);

    Route::post('/category/{category}', [CategoryController::class, 'updateCategory']);
    Route::post('/category', [CategoryController::class, 'store']);

    Route::post('/banner', [BannerController::class, 'store']);
    Route::post('/banner/{banner}', [BannerController::class, 'updateBanner']);
    Route::delete('/banner/{banner}', [BannerController::class, 'destroy']);

    Route::apiResource('/payments', PaymentController::class);
    Route::post('/payments/order', [PaymentController::class, 'getOrder']);
    Route::post('/payments/{payment}/update-status', [PaymentController::class, 'updateStatus']);

    Route::post('/privacy', [PrivacyController::class, 'store']);
    
    Route::post('/privacy/{id}', [PrivacyController::class, 'update']);

    Route::post('/term', [TermController::class, 'store']);
    Route::post('/term/{id}', [TermController::class, 'update']);

    Route::post('/payments-gateway', [PaymentGatewayController::class, 'store']);
    Route::get('/payments-gateway', [PaymentGatewayController::class, 'index']);
    Route::post('/payments-gateway/{id}', [PaymentGatewayController::class, 'update']);
});
Route::get('/admin/term', [TermController::class, 'index']);
Route::get('/admin/privacy', [PrivacyController::class, 'index']);
