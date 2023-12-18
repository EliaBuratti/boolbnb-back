<?php

use App\Http\Controllers\Host\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Host\ApartmentController;
use App\Http\Controllers\Host\ImageController;
use App\Http\Controllers\Host\MessageController;
use App\Http\Controllers\Host\ViewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */
/* 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::resource('services', ServiceController::class)->parameters(['services' => 'service:slug']);
    Route::resource('sponsorships', SponsorshipController::class);
});

Route::middleware(['auth', 'verified'])->prefix('host')->name('host.')->group(function () {

    Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);

    Route::delete('/apartment/images/{image}/destroy', [ImageController::class, 'destroy'])->name('deleteImg');
    Route::post('/apartment/images', [ImageController::class, 'store'])->name('addImg');

    Route::get('apartment/trash', [ApartmentController::class, 'trash_apartments'])->name('trash');
    Route::put('/apartment/trash/{apartments}/restore', [ApartmentController::class, 'restore'])->name('restore');
    Route::delete('/apartment/trash/{apartments}/destroy', [ApartmentController::class, 'forceDelete'])->name('forceDelete');
    Route::get('/apartment/{apartments}/sponsorship', [ApartmentController::class, 'sponsorship'])->name('sponsorship');

    Route::resource('messages', MessageController::class);
    Route::resource('views', ViewController::class);
});
Route::post('payment/process', [PaymentController::class, 'index'])->name('payment.process');
Route::get('payment/token', [PaymentController::class, 'genToken'])->name('payment.token');

require __DIR__ . '/auth.php';
