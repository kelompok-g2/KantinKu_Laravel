<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/menus', [MenuController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/menus/{menu}', [MenuController::class, 'show'])->whereNumber('menu');
Route::middleware('throttle:10,1')->group(function () {
    Route::post('/auth/register', [AccountController::class, 'register']);
    Route::post('/auth/login', [AccountController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AccountController::class, 'me']);
    Route::post('/auth/logout', [AccountController::class, 'logout']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{order}', [OrderController::class, 'show'])->whereNumber('order');
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'read'])->whereUuid('id');

    Route::middleware('canteen-admin')->group(function () {
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::patch('/categories/{category}', [CategoryController::class, 'update'])->whereNumber('category');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->whereNumber('category');
        Route::post('/menus', [MenuController::class, 'store']);
        Route::patch('/menus/{menu}', [MenuController::class, 'update'])->whereNumber('menu');
        Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->whereNumber('menu');
        Route::get('/admin/orders', [OrderController::class, 'all']);
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->whereNumber('order');
    });
});
