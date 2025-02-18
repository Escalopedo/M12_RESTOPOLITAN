<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener todos los restaurantes
        $restaurants = Restaurant::all();
        $users = User::all();
        
        // Pasarlos a la vista 'admin'
        return view('admin', compact('restaurants','users'));
    }
}
