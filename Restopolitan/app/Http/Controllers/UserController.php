<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Mostrar la lista de usuarios
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            return response()->json($users); // Retorna los usuarios en formato JSON
        }

        $users = User::all();
        return view('admin', compact('users'));
    }

    // Editar un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user); // Devuelve los datos del usuario en formato JSON
    }
    
    // Actualizar un usuario
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validación
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);
    
        // Actualización
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->role_id = $request->input('role_id');
        $user->save();

        $roleName = $user->role->name;
    
        return response()->json(['success' => true, 'role_name' => $roleName]);
    }
    

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return response()->json(['success' => 'Usuario eliminado con éxito.']);
    }
}
