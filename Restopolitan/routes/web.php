<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController; // Agregar el AuthController
use Illuminate\Http\Request;
use App\Models\Restaurant;

// Ruta para la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta para la página detalles
Route::get('/restaurants/{id}', [RestaurantController::class, 'show'])->name('restaurants.details');
Route::post('/restaurants/{id}/review', [ReviewController::class, 'store'])->name('reviews.store');
// Rutas para restaurantes
Route::resource('restaurants', RestaurantController::class);

// Rutas de autenticación (Login, Registro y Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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