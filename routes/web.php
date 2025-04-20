<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DrinksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminDashboardController;  // Import AdminDashboardController
use App\Http\Controllers\SliderImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\PasswordController;

// ✅ Public Pages (Accessible to Everyone)
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/drinks/{id}', 'drinks')->name('drinks');  // Updated to use 'id' instead of 'drinks'
    Route::get('/posts', 'posts')->name('post');
    Route::get('/gallery', 'gallery')->name('gallery'); 
    Route::post('/gallery', 'galleryStore')->name('gallery.store'); 
    Route::get('/orders', 'orders')->name('orders.index'); 
});


// ✅ User Dashboard (Only Authenticated Users)
Route::middleware(['auth', 'verified'])->group(function () {

    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/order/confirmation/{order}', [OrderController::class, 'confirmation'])->name('order.confirmation');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ✅ User Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

// ✅ Authentication Routes (Register, Login, Logout)
require __DIR__.'/auth.php';

// ✅ Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});

// ✅ Admin Routes (Only Accessible to Admins)
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard Route
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');  // Added AdminDashboardController

    // Admin Profile Routes
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');  // This is `admin.profile.edit`
        Route::put('/', [AdminProfileController::class, 'update'])->name('update');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    // Slider Routes
    Route::get('sliders', [SliderImageController::class, 'index'])->name('sliders.index');
    Route::get('sliders/create', [SliderImageController::class, 'create'])->name('sliders.create');
    Route::post('sliders', [SliderImageController::class, 'store'])->name('sliders.store');
    Route::get('sliders/{id}/edit', [SliderImageController::class, 'edit'])->name('sliders.edit');
    Route::put('sliders/{id}', [SliderImageController::class, 'update'])->name('sliders.update');
    Route::delete('sliders/{id}', [SliderImageController::class, 'destroy'])->name('sliders.destroy');

    // Category Routes
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Drink Routes
    Route::get('drinks', [DrinksController::class, 'index'])->name('drinks.index');
    Route::get('drinks/create', [DrinksController::class, 'create'])->name('drinks.create');
    Route::post('drinks', [DrinksController::class, 'store'])->name('drinks.store');
    Route::get('drinks/{id}/edit', [DrinksController::class, 'edit'])->name('drinks.edit');
    Route::put('drinks/{id}', [DrinksController::class, 'update'])->name('drinks.update');
    Route::delete('drinks/{id}', [DrinksController::class, 'destroy'])->name('drinks.destroy');

    // Order Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::middleware('guest')->group(function () {
    // Show the "Forgot Password" form
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

    // Handle the form submission to send the reset link
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    // Show the password reset form (from email link)
    Route::get('reset-password/{token}', [PasswordController::class, 'edit'])->name('password.reset');

    // Handle the password reset form submission
    Route::post('reset-password', [PasswordController::class, 'update'])->name('password.update');
});