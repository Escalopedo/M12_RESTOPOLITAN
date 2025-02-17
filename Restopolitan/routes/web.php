<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

// Ruta de detalle del restaurante
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurant.show');

// Ruta para la búsqueda de restaurantes
Route::get('/search', function (Request $request) {
    $query = $request->input('query');

    $restaurants = Restaurant::join('locations', 'restaurants.location_id', '=', 'locations.id')
    ->where('restaurants.name', 'like', "%$query%")
    ->orWhere('locations.street_address', 'like', "%$query%")
    ->orWhere('locations.city', 'like', "%$query%")
    ->select('restaurants.*') // Muestra los datos de la tabla restaurants
    ->get();

    return view('partials.restaurants', compact('restaurants'));
});

// Ruta protegida para administradores
Route::get('/admin', function () {
    // Verifica si el usuario está autenticado y tiene el rol 'Admin'
    if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Admin') {
        // Obtener todos los restaurantes
        $restaurants = Restaurant::all(); // Esto obtiene todos los restaurantes de la base de datos
        
        // Pasar los restaurantes a la vista
        return view('Admin', compact('restaurants')); // Asegúrate de pasar la variable correctamente
    }

    // Si no es admin, redirige con mensaje de error
    return redirect('/')->with('error', 'No tienes permisos para acceder a esta página');
})->name('admin.index')->middleware('auth');


