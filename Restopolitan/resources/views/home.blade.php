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
            <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Restopolitan Logo" width="150">
            </a>
            <form class="search-form" id="search-form">
                <input type="text" class="form-control" id="-searchinput" placeholder="Búsqueda por nombre, precio, valoración, tipo de cocina...">
                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
            </form>            
            <ul class="nav-links">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <li><a href="{{ route('register') }}" class="subscribe-btn">¡REGÍSTRATE!</a></li>
                @endguest
            
                @auth
                    <li>
                        <a href="{{ route('logout') }}" id="logout-button" class="btn btn-danger">
                            Cerrar sesión
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </ul>            
        </div>
    </nav>
    
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1>LA SUSCRIPCIÓN PARA LOS AMANTES DE LA GASTRONOMÍA</h1>
            <p>1 persona invitada en cada reserva</p>
            <p class="price">119 € / AÑO</p>
        </div>
    </section>

    <!-- Sección de Destacados -->
    <section class="container mt-5">
        <h2 class="text-center">Restaurantes Destacados</h2>
        <div class="row" id="restaurants-container">
            @foreach($restaurants as $restaurant)
                <div class="col-md-4 restaurant-item">
                    <div class="card">
                        <img src="{{ asset('images/' . $restaurant->photo) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $restaurant->name }}</h5>
                            <p class="card-text">{{ $restaurant->description }}</p>
                            <a href="#" class="btn btn-outline-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>    

    <!-- Sección Slider con imágenes de la base de datos -->
    <section class="details-section">
        <div class="container">
            <h2>Descubre Nuestros Restaurantes</h2>
            <div id="carouselCuenta" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($restaurants as $index => $restaurant)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/' . $restaurant->photo) }}" class="d-block w-100" alt="{{ $restaurant->name }}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $restaurant->name }}</h5>
                                <p>{{ $restaurant->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCuenta" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselCuenta" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
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
                <p>&copy; {{ date('Y') }} Restopolitan. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>