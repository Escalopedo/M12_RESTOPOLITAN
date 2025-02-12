<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restopolitan - Suscripción Gastronómica</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Fuentes de Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                RESTOPOLITAN
            </a>
            <form class="search-form">
                <input type="text" class="form-control" placeholder="Búsqueda por nombre, dirección, ciudad...">
                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
            </form>
            <ul class="nav-links">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <li><a href="{{ route('register') }}" class="subscribe-btn">¡REGISTRATE!</a></li>
            </ul>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1>LA SUSCRIPCIÓN PARA LOS AMANTES DE LA GASTRONOMÍA</h1>
            <p>1 persona invitada en cada reserva</p>
            <p class="price">119 € / LARO</p>
        </div>
    </section>
    <!-- Sección de Beneficios -->
    <section class="benefits-section">
        <div class="container">
            <h2>1 PERSONA INVITADA EN CADA RESERVA</h2>
            <div class="row">
                <div class="col-md-4">
                    <h3>INVITADO</h3>
                    <p>Un entorno y el sitio de un plato y un plato desarrollado de la cuenta desde tu primera reserva.</p>
                </div>
                <div class="col-md-4">
                    <h3>RESERVA EN DELEC</h3>
                    <p>Espléndidos dónde ha aplicado la dotación a web.</p>
                </div>
                <div class="col-md-4">
                    <h3>SEPARAN EN UN CASA</h3>
                    <p>Reserva treinta veces como quieres, si ves, tú vaces, tos veces. ¡Es limitador!</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Sección de Detalles -->
    <section class="details-section">
        <div class="container">
            <h2>CIENTA</h2>
            <ul>
                <li>Inventidad de carácter público: 2.000 horas de trabajo (mínimo 3 años)</li>
                <li>Desarrollo de carácter público: 0.000 horas de trabajo (mínimo 5 años)</li>
                <li>Desarrollo de carácter público: 0.000 horas de trabajo (mínimo 10 años)</li>
                <li>Desarrollo de carácter público: 0.000 horas de trabajo (mínimo 20 años)</li>
                <li>Desarrollo de carácter público: 0.000 horas de trabajo (mínimo 30 años)</li>
            </ul>
        </div>
    </section>
    <!-- Sección de LECTORES -->
    <section class="readers-section">
        <div class="container">
            <h2>LECTORES</h2>
            <div class="row">
                <div class="col-md-4">
                    <h3>BAS-TRAPS ZZATSÁN</h3>
                    <p>Valores de 90 €</p>
                </div>
                <div class="col-md-4">
                    <h3>LA TERRENA DEL EO</h3>
                    <p>Cuenta del año</p>
                </div>
                <div class="col-md-4">
                    <h3>La presencia incluida a todos a través de la Casa</h3>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="footer bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Restopolitan</h5>
                    <p>Descubre los mejores restaurantes y vive experiencias únicas.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Inicio</a></li>
                        <li><a href="#" class="text-white">Suscripción</a></li>
                        <li><a href="#" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>Email: info@restopolitan.es</p>
                    <p>Teléfono: +34 123 456 789</p>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2023 Restopolitan. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>