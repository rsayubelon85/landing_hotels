<?php

use App\Http\Controllers\Admin\PromotionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HotelController;
use App\Http\Controllers\Admin\HeaderConfigController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
require __DIR__.'/auth.php';

// Rutas de administración (protegidas)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Gestión de Hoteles
    Route::resource('hotels', HotelController::class);

    // Rutas de Promociones
    Route::resource('promotions', PromotionController::class)->names('promotions');

    // Configuración del Header
    Route::get('header/edit', [HeaderConfigController::class, 'edit'])->name('header.edit');
    Route::put('header/update', [HeaderConfigController::class, 'update'])->name('header.update');
});
