<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelController;

// Rutas API públicas
Route::get('/hotels', [HotelController::class, 'index'])->name('api.hotels.index');

// Rutas API protegidas
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::apiResource('hotels', HotelController::class);
});

Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/autocomplete', [HotelController::class, 'autocomplete'])->name('api.hotels.autocomplete');
