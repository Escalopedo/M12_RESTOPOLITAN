<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Http\Controllers\CuisineTypeController;

// Ruta para la página de inicio
//Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', [RestaurantController::class, 'index'])->name('home');

// Ruta para la página de detalles de un restaurante
Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.details');
Route::post('/restaurants/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');

// CRUD de Restaurantes
Route::resource('restaurants', RestaurantController::class)->middleware('auth');

// Rutas de autenticación (Login, Registro y Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/search', [RestaurantController::class, 'search'])->name('restaurants.search');
Route::resource('cuisine_types', CuisineTypeController::class);

Route::get('/search', function (Request $request) {
    $query = $request->input('query');

    $restaurants = Restaurant::join('locations', 'restaurants.location_id', '=', 'locations.id')
    ->where('restaurants.name', 'like', "%$query%")
    ->orWhere('locations.street_address', 'like', "%$query%")
    ->orWhere('locations.city', 'like', "%$query%")
    ->select('restaurants.*') //Muestra los datos de la tabla restaurants
    ->get();

    /*$restaurants = Restaurant::join('cuisine_types', 'restaurants.cuisine_type_id', '=', 'cuisine_types.id')
    ->where('restaurants.name', 'like', "%$query%")
    ->orWhere('cuisine_types.name', 'like', "%$query%")
    ->select('restaurants.*') //Muestra los datos de la tabla restaurants
    ->get();*/

    return view('partials.restaurants', compact('restaurants'));
});