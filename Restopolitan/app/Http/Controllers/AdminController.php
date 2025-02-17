<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener todos los restaurantes
        $restaurants = Restaurant::all();
        
        // Pasarlos a la vista 'admin'
        return view('admin', compact('restaurants'));
    }
}
