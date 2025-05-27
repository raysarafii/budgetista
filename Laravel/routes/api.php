<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\WishlistController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/items', [ItemController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::post('/profile/update', [UserController::class, 'updateProfile']);
    Route::post('/user/saldo', [UserController::class, 'updateSaldo']);
    Route::get('/wishlists', [WishlistController::class, 'index']);
    Route::post('/wishlists', [WishlistController::class, 'store']);
    Route::post('/wishlists/beli', [WishlistController::class, 'beli']);
    Route::get('/wishlists/status', [WishlistController::class, 'showByStatus']);
    Route::post('wishlists/beli-hapus', [WishlistController::class, 'beliwishlist']);
    Route::post('/wishlists/upload', [WishlistController::class, 'uploadGambar']);
});

