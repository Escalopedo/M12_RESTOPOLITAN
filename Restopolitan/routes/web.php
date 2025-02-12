<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController; // Agregar el AuthController

// Ruta para la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas para restaurantes
Route::resource('restaurants', RestaurantController::class);

// Rutas de autenticación (Login, Registro y Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
