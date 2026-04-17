<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\CartController;

// Các route cho Giỏ hàng
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkout/success', [CartController::class, 'success'])->name('checkout.success');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/search-suggest', [ProductController::class, 'suggest'])->name('product.suggest');
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('product.detail');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/admin', [AdminController::class, 'index']);

// QUẢN LÝ DANH MỤC
Route::prefix('admin/category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index'); 
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
});

// QUẢN LÝ SẢN PHẨM
Route::prefix('admin/product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
});

// QUẢN LÝ TÁC GIẢ
Route::prefix('admin/author')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('author.index');
    Route::post('/store', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/delete/{id}', [AuthorController::class, 'delete'])->name('author.delete');
});

// QUẢN LÝ THƯƠNG HIỆU
Route::prefix('admin/brand')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
});

// QUẢN LÝ SLIDER
Route::prefix('admin/slider')->group(function () {
    Route::get('/', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
});

// QUẢN LÝ ĐƠN HÀNG
Route::prefix('admin/orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/{id}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/{id}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::post('/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/{id}/delivered', [OrderController::class, 'delivered'])->name('orders.delivered');
});

/*
|--------------------------------------------------------------------------
| PHẦN TÀI KHOẢN KHÁCH HÀNG
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/post-login', [UserController::class, 'postLogin'])->name('postLogin');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/post-register', [UserController::class, 'postRegister'])->name('postRegister');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Nhóm route yêu cầu BẮT BUỘC ĐĂNG NHẬP mới được vào
Route::middleware('auth')->group(function () {
    // Route hiển thị form profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    // Route xử lý khi bấm nút "Cập nhật"
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
});