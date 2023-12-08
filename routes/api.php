<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SponsorshipController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/apartments/{apartment:slug}', [ApartmentController::class, 'show']);


Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service:slug}', [ServiceController::class, 'show']);


Route::get('/sponsorships', [SponsorshipController::class, 'index']);
