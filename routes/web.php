<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Common  routes
Route::resource('cars', CarController::class);
Route::resource('appointments', AppointmentController::class)->only(['index', 'create', 'store', 'show']);
Route::resource('bids', BidController::class)->only(['index', 'create', 'store', 'show']);

// Common routes for cars with admin middleware
Route::patch('/cars/{car}/toggle-status', [CarController::class, 'toggleStatus'])
    ->name('cars.toggle-status')
    ->middleware(['auth']);


// Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
// Route::post('/admin/transactions/{transaction}/sell', [TransactionController::class, 'sell'])->name('admin.transactions.sell');
// Route::post('/admin/transactions/{transaction}/deny', [TransactionController::class, 'deny'])->name('admin.transactions.deny');

// Add this route group with prefix and name
Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('users', [AdminController::class, 'users'])->name('users.index');
    Route::patch('users/{user}/promote', [AdminController::class, 'promote'])->name('users.update');
    //Route::get('cars', [CarController::class, 'adminIndex'])->name('cars.index');
    Route::get('appointments', [AppointmentController::class, 'adminIndex'])->name('appointments.index');
    Route::post('appointments/{appointment}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
    Route::post('appointments/{appointment}/deny', [AppointmentController::class, 'deny'])->name('appointments.deny');
    // Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('cars', [AdminController::class, 'cars'])->name('cars.index');
    Route::patch('cars/{car}/activate', [AdminController::class, 'activateCar'])->name('cars.activate');
    Route::patch('cars/{car}/deactivate', [AdminController::class, 'deactivateCar'])->name('cars.deactivate');
    Route::resource('cars', AdminController::class)->except(['create', 'store', 'show']);

    Route::get('/admin/bids', [BidController::class, 'adminIndex'])->name('bids.index');
    // Manage Transactions

});
// Admin Cars routes
Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('cars', [CarController::class, 'adminIndex'])->name('cars.index');
    Route::put('cars/{car}', [CarController::class, 'adminUpdate'])->name('cars.update');
});

Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    Route::put('cars/{car}/status', [CarController::class, 'updateCarStatus'])
        ->name('cars.status.update');
});

Route::patch('/cars/{car}/toggle-status', [CarController::class, 'toggleStatus'])
    ->name('cars.toggle-status')
    ->middleware(['auth']);


// Admin Transactions routes
Route::get('/admin/transactions', [TransactionController::class, 'index'])->name('admin.transactions.index');
Route::post('/admin/transactions/{transaction}/sell', [TransactionController::class, 'sell'])->name('admin.transactions.sell');
Route::post('/admin/transactions/{transaction}/deny', [TransactionController::class, 'deny'])->name('admin.transactions.deny');

// Invoice route
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])
    ->name('invoices.show')
    ->middleware('can:view,invoice');

Route::get('/admin/invoices', [InvoiceController::class, 'index'])
    ->name('admin.invoices.index')
    ->middleware('can:viewAny,App\Models\Invoice');

Route::post('/admin/invoices/{invoice}/resend', [InvoiceController::class, 'resend'])
    ->name('admin.invoices.resend')
    ->middleware('can:resend,invoice');

require __DIR__ . '/auth.php';
