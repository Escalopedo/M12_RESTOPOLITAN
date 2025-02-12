<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restopolitan - Guía de Restaurantes</title>
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo + Buscador -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-3" href="{{ route('home') }}">Restopolitan</a>
                <form class="d-flex search-form">
                    <input class="form-control me-2" type="search" placeholder="Buscar restaurantes..." aria-label="Buscar">
                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                </form>
            </div>

            <!-- Botones de Login y Registro -->
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-danger">Registrarse</a>
            </div>
        </div>
    </nav>

    <!-- Sección Hero -->
    <header class="hero-section">
        <div class="container text-center">
            <h1>Descubre los Mejores Restaurantes</h1>
            <p>Explora los mejores restaurantes y vive una experiencia gastronómica única.</p>
            <a href="{{ route('restaurants.index') }}" class="btn btn-primary btn-lg">Explorar Restaurantes</a>
        </div>
    </header>

    <!-- Sección de Destacados -->
    <section class="container mt-5">
        <h2 class="text-center">Restaurantes Destacados</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/restaurant1.jpg') }}" class="card-img-top" alt="Restaurante 1">
                    <div class="card-body">
                        <h5 class="card-title">Restaurante Gourmet</h5>
                        <p class="card-text">Una experiencia culinaria excepcional en un ambiente elegante.</p>
                        <a href="#" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/restaurant2.jpg') }}" class="card-img-top" alt="Restaurante 2">
                    <div class="card-body">
                        <h5 class="card-title">Sabor Mediterráneo</h5>
                        <p class="card-text">Disfruta de auténticos sabores mediterráneos con ingredientes frescos.</p>
                        <a href="#" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/restaurant3.jpg') }}" class="card-img-top" alt="Restaurante 3">
                    <div class="card-body">
                        <h5 class="card-title">Fusión Asiática</h5>
                        <p class="card-text">Una mezcla de sabores asiáticos en un solo lugar.</p>
                        <a href="#" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <p>&copy; {{ date('Y') }} Restopolitan. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
