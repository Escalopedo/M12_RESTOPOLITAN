<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restopolitan</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <h1 class="navbar-brand">Restopolitan</h1>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="container">
        <h2>CONEXIÓN</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>E-mail:</label>
            <input type="email" name="email" placeholder="Ingresa tu correo electrónico" required>
            <label>Contraseña:</label>
            <input type="password" name="password" placeholder="Ingresa tu contraseña" required>
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