<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\StoreController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/registration', RegistrationController::class)->name('auth.register');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/get-user-stores/{user_id}', [StoreController::class, 'index'])->name('user.stores');
    Route::post('/create-user-store', [StoreController::class, 'create'])->name('user.create-store');
    Route::put('/update-user-store/{store_id}', [StoreController::class, 'update'])->name('user.update-store');
    Route::delete('/delete-user-store/{store_id}', [StoreController::class, 'delete'])->name('user.delete-store');
});
