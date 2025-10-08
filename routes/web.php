<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemImageController;
use App\Http\Controllers\Admin\HistoryBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Home Public
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/items/{id}', [HomeController::class, 'show'])->name('home.show');
Route::get('/check-availability', [BookingController::class, 'checkAvailability'])->name('home.check-availability');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Home
    Route::get('/history', [HomeController::class, 'history'])->name('home.history');

    // Bookings
    Route::get('/bookings/create/{item}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});

Route::middleware(['auth', 'isadmin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Items
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');
    Route::get('/items/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/update/{id}', [ItemController::class, 'update'])->name('items.update');
    Route::get('/items/{id}', [ItemController::class, 'show'])->name('items.show');
    Route::delete('/items/{id}', [ItemController::class, 'destroy'])->name('items.destroy');

    // Item Images
    Route::delete('/item-images/{id}', [ItemImageController::class, 'destroy'])->name('item-images.destroy');
    Route::get('/item-images/{id}/edit', [ItemImageController::class, 'edit'])->name('item-images.edit');
    Route::put('/item-images/{id}', [ItemImageController::class, 'update'])->name('item-images.update');
    Route::post('/item-images/{item}', [ItemImageController::class, 'store'])->name('item-images.store');

    Route::get('/bookings', [HistoryBookingController::class, 'index'])->name('bookings.index');
});

// Login With Google
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__ . '/auth.php';
