@foreach($restaurants as $restaurant)
    <div class="col-md-4 restaurant-item">
        <div class="card">
            <img src="{{ asset('images/' . $restaurant->photo) }}" class="card-img-top" alt="{{ $restaurant->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $restaurant->name }}</h5>
                <p class="card-text"><strong>Tipo de cocina:</strong> {{ $restaurant->cuisine_name }}</p>
                <p class="card-text"><strong>Precio medio:</strong> €{{ number_format($restaurant->average_price, 2) }}</p>
                <p class="card-text"><strong>Valoración:</strong> ⭐{{ number_format($restaurant->avg_rating, 1) }}</p>
                <a href="#" class="btn btn-outline-primary">Ver más</a>
            </div>
        </div>
    </div>
@endforeach