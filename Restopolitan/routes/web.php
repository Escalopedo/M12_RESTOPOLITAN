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

// Ruta para la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Ruta para la búsqueda de restaurantes con AJAX
Route::get('/search', function (Request $request) {
    $query = $request->input('query');

    $restaurants = Restaurant::join('locations', 'restaurants.location_id', '=', 'locations.id')
        ->where('restaurants.name', 'like', "%$query%")
        ->orWhere('locations.street_address', 'like', "%$query%")
        ->orWhere('locations.city', 'like', "%$query%")
        ->select('restaurants.*')
        ->get();

    return view('partials.restaurants', compact('restaurants'));
})->name('restaurants.search');

// Ruta protegida para administradores (Página de Admin)
Route::middleware(['auth'])->group(function () {

    // Ruta de Admin, ahora apunta al AdminController
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // CRUD de Usuarios con AJAX
    Route::resource('users', UserController::class)->middleware('auth');

    // CRUD de Restaurantes con AJAX (Para administradores)
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');
        Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update'])->name('restaurants.update');
        Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurants.destroy');
    });
});
