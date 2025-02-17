<?php
namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    // Método que se llama cuando accedes a /restaurants
    public function index()
    {
        $restaurants = Restaurant::all(); // Obtienes todos los restaurantes
        return view('restaurants.index', compact('restaurants')); // Pasas los restaurantes a la vista
    }

    // Otros métodos de Store, Show, Create, etc.
    public function show($id)
    {
        $restaurant = Restaurant::with('location')->findOrFail($id); // Obtiene el restaurante con el ID especificado
        return view('restaurants.details', compact('restaurant')); // Pasas el restaurante a la vista
    }
}