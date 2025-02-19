<table class="table table-hover">
    <tbody id="restaurant-list">
        @foreach($restaurants as $restaurant)
            <tr id="restaurant-{{ $restaurant->id }}">
                <td>{{ $restaurant->id }}</td>
                <td>{{ $restaurant->name }}</td>
                <td>{{ $restaurant->description }}</td>
                <td>{{ $restaurant->average_price }}€</td>
                <td>{{ $restaurant->gerente ? $restaurant->gerente->name : 'No asignado' }}</td>
                <td>{{ $restaurant->location ? $restaurant->location->street_address : 'No asignado' }}</td>
                <td>
                    <button class="btn btn-primary edit-restaurant" data-id="{{ $restaurant->id }}">Editar</button>
                    <button class="btn btn-danger delete-restaurant" data-id="{{ $restaurant->id }}">Eliminar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>