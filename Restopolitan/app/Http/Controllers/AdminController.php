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

    public function filterRestaurants(Request $request)
    {
        $query = Restaurant::with(['gerente', 'location']);

        // Filtro por nombre
        if ($request->has('name') && !empty($request->input('name'))) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filtro por precio mínimo
        if ($request->has('min_price') && !empty($request->input('min_price'))) {
            $query->where('average_price', '>=', $request->input('min_price'));
        }

        // Filtro por precio máximo
        if ($request->has('max_price') && !empty($request->input('max_price'))) {
            $query->where('average_price', '<=', $request->input('max_price'));
        }

        // Filtro por gerente (buscando por nombre en lugar de ID)
        if ($request->has('gerente') && !empty($request->input('gerente'))) {
            $query->whereHas('gerente', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('gerente') . '%');
            });
        }

        // Filtro por ubicación (buscando por dirección en lugar de ID)
        if ($request->has('location') && !empty($request->input('location'))) {
            $query->whereHas('location', function ($q) use ($request) {
                $q->where('street_address', 'like', '%' . $request->input('location') . '%');
            });
        }

        $restaurants = $query->get();

        return view('partials.restaurantsAdmin', compact('restaurants'));
    }
}
