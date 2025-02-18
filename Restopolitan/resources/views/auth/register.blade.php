<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <!-- Fuentes de Google -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Restopolitan Logo" width="150">
            </a>            
        </div>
    </nav>

    <div class="container">
        <h2>Creación de la cuenta</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Botón para mostrar el formulario -->
        <button id="showFormButton" class="showFormButton">Registrar con e-mail</button>

        <!-- Formulario (inicialmente oculto) -->
        <form id="registrationForm" method="POST" action="{{ route('register') }}" class="hidden">
            <h3>Inscríbete con E-mail</h3>
            @csrf
            <div class="form-group">
                <div>
                    <label>Nombre:</label>
                    <input type="text" name="name" id="name" onblur="validarNombre()">
                    <span id="errorNombre"></span>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="email" name="email" id="email" onblur="validarCorreo()">
                    <span id="errorCorreo"></span>
                </div>
            </div>

            <label>Contraseña:</label>
            <input type="password" name="password" id="password" onblur="validarContrasena()">
            <span id="errorContra"></span><br><br>

            <label>Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" onblur="validarConfirmarContrasena()">
            <span id="errorConfirmar"></span><br><br>

            <button type="submit">Crear mi cuenta</button>
        </form>
        <br>
        <a href="{{ route('login') }}">Ya tengo cuenta</a>
    </div>

    <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>