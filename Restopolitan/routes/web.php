<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;

// Ruta para la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para restaurantes
Route::resource('restaurants', RestaurantController::class);
