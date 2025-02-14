<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restopolitan</title>
    <script src="{{ asset('js/login.js') }}" defer></script> <!-- Archivo JavaScript externo -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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

    <!-- Contenedor del formulario -->
    <div class="container">
        <h2>CONEXIÓN</h2>
        <form id="loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            <label>E-mail:</label>
            <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico">
            <span class="error-message" id="emailError" style="color: red; font-size: 14px;"></span>
            <label>Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña">
            <span class="error-message" id="passwordError" style="color: red; font-size: 14px;"></span><br>
            <a href="#" class="forgot-password">¿Has olvidado tu contraseña?</a>
            <button type="submit">IDENTIFICATE</button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span>o</span>
        </div>

        <!-- Botón de Facebook -->
        <button class="fb-login">
            <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook Icon" width="20">
            INICIA SESIÓN CON FACEBOOK
        </button>

        <!-- Enlace de registro -->
        <a href="{{ route('register') }}" class="register-link">Aún no tengo cuenta</a>
    </div>
</body>
</html>