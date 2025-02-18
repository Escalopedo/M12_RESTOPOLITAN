<?php
namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use App\Models\Role;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::all();

        // Obtener todos los restaurantes con las relaciones de gerente y ubicación
        $restaurants = Restaurant::with(['gerente', 'location'])->get();
        
        // Obtener los usuarios con el rol de "gerente"
        $gerentes = User::whereHas('role', function ($query) {
            $query->where('name', 'gerente'); 
        })->get();
        
        // Obtener todas las ubicaciones
        $locations = Location::all();

        $roles = Role::all();
        
        // Pasar los datos a la vista
        return view('admin', compact('users','restaurants', 'gerentes', 'locations','roles'));
    }

    public function filterUsers(Request $request)
    {
        $query = User::join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('users.*', 'roles.name as role_name');

        // Filtro por nombre
        if ($request->has('name') && !empty($request->input('name'))) {
            $query->where('users.name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtro por email
        if ($request->has('email') && !empty($request->input('email'))) {
            $query->where('users.email', 'like', '%' . $request->input('email') . '%');
        }

        // Filtro por rol
        if ($request->has('role') && !empty($request->input('role'))) {
            $query->where('roles.name', '=', $request->input('role'));
        }

        $users = $query->get();

        // Devuelve la vista parcial con los resultados actualizados
        return view('partials.userAdmin', compact('users'));
    }
}
