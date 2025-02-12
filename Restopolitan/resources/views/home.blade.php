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
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Restopolitan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('restaurants.index') }}">Restaurantes</a></li>
                </ul>
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
            <!-- Ejemplo de tarjeta de restaurante -->
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