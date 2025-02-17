<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Restaurantes - Administrador</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

    <h1>Lista de Restaurantes</h1>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio Promedio (€)</th>
                <th>Foto</th>
                <th>Gerente</th>
                <th>Valoración</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ Str::limit($restaurant->description, 100, '...') }}</td> <!-- Limita la descripción -->
                    <td>{{ number_format($restaurant->average_price, 2) }} €</td>
                    <td>
                        @if($restaurant->photo)
                            <img src="{{ asset('storage/' . $restaurant->photo) }}" alt="Foto del restaurante">
                        @else
                            <span>No disponible</span>
                        @endif
                    </td>
                    <td>{{ $restaurant->gerente ? $restaurant->gerente->name : 'No asignado' }}</td>
                    <td>{{ $restaurant->rating ? number_format($restaurant->rating, 1) : 'No valorado' }}</td>
                    <td>{{ $restaurant->location ? $restaurant->location->city : 'Sin ubicación' }}</td>
                    <td>
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Editar</a>

                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este restaurante?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
