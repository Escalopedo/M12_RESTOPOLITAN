<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Role;
use App\Models\Location;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::all();

        // Obtener todos los restaurantes con las relaciones de gerente y ubicación
        $restaurants = Restaurant::with(['gerente', 'location'])->get();
        
        // Obtener los usuarios con el rol de "gerente"
        $gerentes = User::whereHas('role', function ($query) {
            $query->where('name', 'gerente'); // Filtrar por el rol "gerente"
        })->get();
        
        // Obtener todas las ubicaciones
        $locations = Location::all();
        
        // Pasar los datos a la vista
        return view('admin', compact('users','restaurants', 'gerentes', 'locations'));
    }
}
