<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validar los datos del formulario: 
        // el email debe ser válido y la contraseña no puede estar vacía
        $request->validate([
            'email' => 'required|email', 
         // Verifica que el campo email no esté vacío y sea un email válido
            'password' => 'required',
            // Verifica que el campo contraseña no esté vacío
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($request->only('email', 'password'))) {
           // Si las credenciales son válidas, regenera la sesión para protegerla contra ataques
            $request->session()->regenerate();

            // Redirige al usuario a la página que intentaba acceder o al dashboard por defecto
            return redirect()->intended('/dashboard');
        }

        // Si la autenticación falla, redirige de vuelta con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.', 
         // Mensaje de error genérico
        ]);
    }

    public function logout(Request $request) {
        //Cerrar la sesión
        Auth::logout();
        //Invalidar la sesión para evitar que se reutilice
        $request->session()->invalidate();
        //Generar un nuevo token de sesión para prevenir ataques CSRF
        $request->session()->regenerateToken();
        //Redirigir al usuario a la página de inicio de sesión
        return redirect('/login');
    }
}