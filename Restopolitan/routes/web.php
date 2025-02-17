<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

// Ruta protegida para administradores (Página de Admin)
Route::get('/admin', function () {
    // Verifica si el usuario está autenticado y tiene el rol 'Admin'
    if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Admin') {
        // Obtener todos los restaurantes
        $restaurants = Restaurant::all();
        
        // Pasar los restaurantes a la vista
        return view('admin', compact('restaurants'));
    }

    // Si no es admin, redirige con mensaje de error
    return redirect('/')->with('error', 'No tienes permisos para acceder a esta página');
})->name('admin.index')->middleware('auth');




// Rutas protegidas para administradores - Editar, Actualizar y Eliminar restaurante
Route::group(['middleware' => ['auth']], function () {
    // Ruta para editar un restaurante
    Route::get('/restaurants/{restaurant}/edit', function ($restaurantId) {
        $restaurant = Restaurant::findOrFail($restaurantId);

        // Verifica si el usuario tiene rol de Admin
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Admin') {
            return view('restaurants.edit', compact('restaurant'));
        }

        return redirect('/')->with('error', 'No tienes permisos para editar este restaurante');
    })->name('restaurants.edit');


// ************************************************************************************************************************************************
    

    // Ruta para actualizar el restaurante
    Route::put('/restaurants/{restaurant}', function (Request $request, $restaurantId) {
        $restaurant = Restaurant::findOrFail($restaurantId);

        // Verifica si el usuario tiene rol de Admin
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Admin') {
            $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'average_price' => 'required|numeric',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'nullable|numeric|min:0|max:5',
                'gerente_id' => 'nullable|exists:users,id',
                'location_id' => 'required|exists:locations,id',
            ]);

            $restaurant->name = $request->name;
            $restaurant->description = $request->description;
            $restaurant->average_price = $request->average_price;

            // Manejo de la foto
            if ($request->hasFile('photo')) {
                $restaurant->photo = $request->file('photo')->store('public/photos');
            }

            // Otros campos
            $restaurant->rating = $request->rating;
            $restaurant->gerente_id = $request->gerente_id;
            $restaurant->location_id = $request->location_id;

            $restaurant->save();

            return redirect()->route('restaurants.index')->with('success', 'Restaurante actualizado con éxito.');
        }

        return redirect('/')->with('error', 'No tienes permisos para actualizar este restaurante');
    })->name('restaurants.update');
    

    // ************************************************************************************************************************************************


    // Ruta para eliminar un restaurante
    Route::delete('/restaurants/{restaurant}', function ($restaurantId) {
        $restaurant = Restaurant::findOrFail($restaurantId);

        // Verifica si el usuario tiene rol de Admin
        if (Auth::check() && Auth::user()->role && Auth::user()->role->name === 'Admin') {
            $restaurant->delete();

            return redirect()->route('restaurants.index')->with('success', 'Restaurante eliminado con éxito.');
        }

        return redirect('/')->with('error', 'No tienes permisos para eliminar este restaurante');
    })->name('restaurants.destroy');
});
