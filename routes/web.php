<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TermController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy');
Route::get('/term', [TermController::class, 'index'])->name('privacy');

Route::get('/login', function () {
    return view('admin.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/banners', function () {
    return view('admin.all_banner');
})->name('banners');

Route::get('/categories', function () {
    return view('admin.all_category');
})->name('categories');

Route::get('/products', function () {
    return view('admin.all_products');
})->name('products');

Route::get('orders', function () {
    return view('admin.all_orders');
})->name('orders');

Route::get('users', function () {
    return view('admin.users');
})->name('users');

Route::get('term', function () {
    return view('admin.term-condition');
})->name('term');

Route::get('privacy', function () {
    return view('admin.privacy');
})->name('privacy');

Route::get('payment-gateway', function () {
    return view('admin.payment-gateway');
})->name('payment-gateway');


if (\Illuminate\Support\Facades\App::environment('local')) {
    Route::get('/playground', function () {
        return (new \App\Mail\OrderdMail(['name' => "prosen"]))->render();
    });
}
