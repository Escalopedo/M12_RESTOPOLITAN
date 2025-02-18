<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Star Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="{{ asset('css/details.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Restopolitan Logo" class="logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">Cerrar sesión</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- Detalles del Restaurante -->
    <section class="restaurant-details">
        <div class="hero-image">
            <div class="image-overlay">
                <img src="{{ asset('images/' . $restaurant->photo) }}" alt="{{ $restaurant->name }}" class="img-fluid">
                <div class="overlay-content">
                    <h1 class="restaurant-name"><strong>{{ $restaurant->name }}</strong></h1>
                    <p class="city">{{ $restaurant->location->city }}</p>
                </div>
                <div class="overlay-color"></div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="info-box">
                        <div class="content-grid">
                            <div class="left-column">
                                <p><img src="{{ asset('images/Location.png') }}" alt=""> {{ $restaurant->location->street_address }}, {{ $restaurant->location->city }}</p>
                                <p class="price-rating"><img src="{{ asset('images/price.png') }}" alt=""> Precio medio: {{ $restaurant->average_price }} €</p><br>
                                <p class="card-text">{{ $restaurant->description }}</p>
                                
                            </div>
                            <div class="right-column">
                                <div class="rating-section">
                                    <p><strong>Valoración Media</strong></p>
                                    <div class="stars">
                                        
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $restaurant->rating ? 'text-warning' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <h1>{{ $restaurant->rating }}</h1>
                                </div>
                            </div>
                        </div>
                        <div >
                        </div>
                    </div>                    
                    @auth
                    <div class="valo">
                        <h4 class="mt-4">Deja tu valoración</h4>
                        <form action="{{ route('reviews.store', $restaurant->id) }}" method="POST">
                            @csrf
                            <div class="mb-3 ">
                                <label for="rating" class="form-label">Valoración</label>
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                        <label for="star{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comentario</label><br>
                                <textarea name="comment" id="comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar valoración</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="footer bg-dark text-white mt-5">
        <div class="container text-center py-4">
            <p>&copy; {{ date('Y') }} Restopolitan. Todos los derechos reservados.</p>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS for Star Rating -->
    <script>
        document.querySelectorAll('.star-rating input').forEach((input, index) => {
            input.addEventListener('change', () => {
                const stars = document.querySelectorAll('.star-rating label');
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('selected');
                    } else {
                        star.classList.remove('selected');
                    }
                });
            });
        });
    </script>
</body>
</html>