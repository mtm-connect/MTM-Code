<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\TwoController;
use App\Http\Controllers\ThreeController;
use App\Http\Controllers\JacketController;
use App\Http\Controllers\ShirtController;
use App\Http\Controllers\TrouserController;
use App\Http\Controllers\WaistcoatController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdersActionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// -----------------------------
// Public/guest or verified blocks
// -----------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    // ✅ Now uses controller
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Keep your other dashboards
    Route::get('/admin/dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');
    Route::get('/super/dashboard', fn () => view('super.dashboard'))->name('super.dashboard');
});
// -----------------------------
// Admin (UNTOUCHED)
// -----------------------------
Route::middleware(['auth','verified','can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{orders}', [AdminOrderController::class, 'show'])->name('orders.show');
        

Route::post('/orders/{order}/send', [OrdersActionController::class, 'send'])->name('orders.send');
Route::post('/orders/{order}/dispatch', [OrdersActionController::class, 'markAsDispatched'])->name('orders.dispatch');
Route::delete('/orders/{order}', [OrdersActionController::class, 'destroy'])->name('orders.destroy');
        
    });

// -----------------------------
// ALWAYS ALLOWED ACCOUNT (no subscription check)
// -----------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
});

// -----------------------------
// PROTECTED: requires active subscription
// Everything below is blocked when subscription is "None"
// -----------------------------
Route::middleware(['auth', 'check.subscription'])->group(function () {

    // Notifications
    Route::get('/notifications/json', [NotificationController::class, 'indexJson'])->name('notifications.json');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

    // Orders
    Route::get('/neworder', [OrderController::class, 'create'])->name('order.create');
    Route::post('/neworder', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/order/{orders}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/order/edit/{orders}/{orderoverview}/{measurement}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::get('/order/view/{orders}/{orderoverview}/{measurement}', [OrderController::class, 'view'])->name('orders.view');

    // Measurements
    Route::get('/measurements/{id}/create', [MeasurementsController::class, 'create'])->name('measurments.form');
    Route::post('/measurements/{id}', [MeasurementsController::class, 'store'])->name('measurments.store');
    Route::get('/orders/{orders}/measurments/{measurement}/edit', [MeasurementsController::class, 'edit'])->name('measurments.edit');
    Route::get('/measurements/{measurement}/{orders}', [MeasurementsController::class, 'show'])->name('measurements.show');
    Route::put('/orders/{orders}/measurments/{measurement}', [MeasurementsController::class, 'update'])->name('measurments.update');

    // Two Piece Suit
    Route::get('/create2/{id}', [TwoController::class, 'create'])->name('two.form');
    Route::post('/create2/{id}', [TwoController::class, 'store'])->name('two.store');
    Route::put('/update/2piece/{two}', [TwoController::class, 'update'])->name('two.update');

    // Three Piece Suit
    Route::get('/create3/{id}', [ThreeController::class, 'create'])->name('three.form');
    Route::post('/create3/{id}', [ThreeController::class, 'store'])->name('three.store');
    Route::put('/update/3piece/{three}', [ThreeController::class, 'update'])->name('three.update');

    // Jacket
    Route::get('/create/jacket/{id}', [JacketController::class, 'create'])->name('jacket.form');
    Route::post('/create/jacket/{id}', [JacketController::class, 'store'])->name('jacket.store');
    Route::put('/update/jacket/{jacket}', [JacketController::class, 'update'])->name('jackets.update');

    // Shirt
    Route::get('/create/shirt/{id}', [ShirtController::class, 'create'])->name('shirt.form');
    Route::post('/create/shirt/{id}', [ShirtController::class, 'store'])->name('shirt.store');
    Route::put('/update/shirt/{shirt}', [ShirtController::class, 'update'])->name('shirt.update');

    // Trouser
    Route::get('/create/trouser/{id}', [TrouserController::class, 'create'])->name('trouser.form');
    Route::post('/create/trouser/{id}', [TrouserController::class, 'store'])->name('trouser.store');
    Route::put('/update/trouser/{trouser}', [TrouserController::class, 'update'])->name('trouser.update');

    // Waistcoat
    Route::get('/create/waistcoat/{id}', [WaistcoatController::class, 'create'])->name('waistcoat.form');
    Route::post('/create/waistcoat/{id}', [WaistcoatController::class, 'store'])->name('waistcoat.store');
    Route::put('/update/waistcoat/{waistcoat}', [WaistcoatController::class, 'update'])->name('waistcoat.update');

    // Stripe Checkout (protected so inactive users can't place orders)
    Route::get('/checkout/{orders}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success/{orders}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel/{orders}', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
