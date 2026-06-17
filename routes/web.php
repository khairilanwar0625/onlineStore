<?php
use Illuminate\Support\Facades\Route;

// Home & About
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('home.about');

// Products
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/products/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('admin.home.index');
    Route::get('/products', [App\Http\Controllers\Admin\AdminProductController::class, 'index'])->name('admin.product.index');
    Route::get('/products/create', [App\Http\Controllers\Admin\AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('/products/store', [App\Http\Controllers\Admin\AdminProductController::class, 'store'])->name('admin.product.store');
    Route::get('/products/{id}/edit', [App\Http\Controllers\Admin\AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/products/{id}/update', [App\Http\Controllers\Admin\AdminProductController::class, 'update'])->name('admin.product.update');
    Route::get('/products/{id}/delete', [App\Http\Controllers\Admin\AdminProductController::class, 'delete'])->name('admin.product.delete');
});

// Auth
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Cart
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/delete', [App\Http\Controllers\CartController::class, 'delete'])->name('cart.delete');
Route::post('/cart/purchase', [App\Http\Controllers\CartController::class, 'purchase'])->name('cart.purchase');

// Orders
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
});