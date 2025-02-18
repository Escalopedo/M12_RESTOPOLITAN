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