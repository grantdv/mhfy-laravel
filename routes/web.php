<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/orders', [OrderHistoryController::class, 'index'])->name('orders.history');
});

// Public Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Inquiry Routes
Route::get('/inquiry', [InquiryController::class, 'create'])->name('inquiry.create');
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/inquiry/success/{order_id}', [InquiryController::class, 'success'])->name('inquiry.success');

// Contact Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/{product}/edit', [App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{order}/invoice', [App\Http\Controllers\Admin\OrderController::class, 'invoice'])->name('admin.orders.invoice');
});

require __DIR__.'/auth.php';
