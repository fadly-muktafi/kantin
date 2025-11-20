<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

Route::get('/', LandingPageController::class);

Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isKasir()) {
            return redirect()->route('kasir.dashboard');
        }
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes - Hanya Produk CRUD
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Products CRUD
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    
    // Categories (untuk produk)
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    
    // Users Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    
    // Reviews (view only)
    Route::resource('reviews', App\Http\Controllers\Admin\ProductReviewController::class)->only(['index', 'show', 'destroy']);
    // Activity Logs
    Route::resource('activity-logs', App\Http\Controllers\Admin\ActivityLogController::class)->only(['index', 'show']);
});

// Kasir Routes - Transaksi dan Laporan
Route::middleware(['auth', 'kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Kasir\KasirDashboardController::class, 'index'])->name('dashboard');
    
    // Transactions
    Route::get('transactions/{transaction}/print', [App\Http\Controllers\Kasir\TransactionController::class, 'print'])->name('transactions.print');
    Route::resource('transactions', App\Http\Controllers\Kasir\TransactionController::class)->except(['edit', 'update', 'destroy']);
    
    // Reports
    Route::get('/reports', [App\Http\Controllers\Kasir\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [App\Http\Controllers\Kasir\ReportController::class, 'exportPdf'])->name('reports.pdf');
});

// Public Routes - Customer beli tanpa login
Route::prefix('public')->name('public.')->group(function () {
    Route::get('/products', [App\Http\Controllers\Public\ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [App\Http\Controllers\Public\ProductController::class, 'show'])->name('products.show');
    Route::post('/products/{product}/review', [App\Http\Controllers\Public\ProductReviewController::class, 'store'])->name('products.review');
    Route::post('/cart/checkout', [App\Http\Controllers\Public\CartController::class, 'checkout'])->name('cart.checkout');
});

require __DIR__.'/auth.php';
