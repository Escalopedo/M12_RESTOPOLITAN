    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio Promedio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ $restaurant->description }}</td>
                    <td>{{ $restaurant->average_price }} €</td>
                    <td>
                        {{-- Botón para editar --}}
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Editar</a>

                        {{-- Formulario para eliminar --}}
                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
