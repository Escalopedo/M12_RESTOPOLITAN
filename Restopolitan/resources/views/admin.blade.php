<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Panel de Administración</h1>

        <!-- Listado de Restaurantes -->
        <h3>Restaurantes</h3>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio Promedio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="restaurant-list">
                @foreach($restaurants as $restaurant)
                    <tr id="restaurant-{{ $restaurant->id }}">
                        <td>{{ $restaurant->id }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->description }}</td>
                        <td>{{ $restaurant->average_price }}€</td>
                        <td>
                            <button class="btn btn-primary edit-restaurant" data-id="{{ $restaurant->id }}">Editar</button>
                            <button class="btn btn-danger delete-restaurant" data-id="{{ $restaurant->id }}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para editar un restaurante -->
        <div id="edit-restaurant-form" class="mt-5" style="display:none;">
            <h3>Editar Restaurante</h3>
            <form id="update-restaurant-form">
                <input type="hidden" id="restaurant-id">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="average_price" class="form-label">Precio Promedio</label>
                    <input type="number" class="form-control" id="average_price" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar Restaurante</button>
                <button type="button" id="cancel-edit" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Función para eliminar un restaurante
            document.querySelectorAll('.delete-restaurant').forEach(button => {
                button.addEventListener('click', function () {
                    const restaurantId = this.dataset.id;
                    Swal.fire({
                        title: "¿Quieres eliminar este restaurante?",
                        text: "¡No podrás revertir esta acción!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/restaurants/${restaurantId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Eliminado', 'El restaurante ha sido eliminado', 'success');
                                    document.getElementById(`restaurant-${restaurantId}`).remove();
                                }
                            });
                        }
                    });
                });
            });

            // Función para editar un restaurante
            document.querySelectorAll('.edit-restaurant').forEach(button => {
                button.addEventListener('click', function () {
                    const restaurantId = this.dataset.id;
                    fetch(`/restaurants/${restaurantId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            // Mostrar el formulario de edición y cargar los datos
                            document.getElementById('restaurant-id').value = data.id;
                            document.getElementById('name').value = data.name;
                            document.getElementById('description').value = data.description;
                            document.getElementById('average_price').value = data.average_price;

                            // Mostrar el formulario de edición
                            document.getElementById('edit-restaurant-form').style.display = 'block';
                        });
                });
            });

            // Función para cancelar la edición
            document.getElementById('cancel-edit').addEventListener('click', function () {
                document.getElementById('edit-restaurant-form').style.display = 'none';
            });

            // Función para enviar el formulario de actualización
            document.getElementById('update-restaurant-form').addEventListener('submit', function (event) {
                event.preventDefault();

                const restaurantId = document.getElementById('restaurant-id').value;
                const name = document.getElementById('name').value;
                const description = document.getElementById('description').value;
                const average_price = document.getElementById('average_price').value;

                fetch(`/restaurants/${restaurantId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: name,
                        description: description,
                        average_price: average_price
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualizar los datos del restaurante directamente en la tabla
                        const restaurantRow = document.getElementById(`restaurant-${restaurantId}`);
                        restaurantRow.querySelector('td:nth-child(2)').textContent = name;
                        restaurantRow.querySelector('td:nth-child(3)').textContent = description;
                        restaurantRow.querySelector('td:nth-child(4)').textContent = `${average_price}€`;

                        // Ocultar el formulario de edición
                        document.getElementById('edit-restaurant-form').style.display = 'none';

                        Swal.fire('Actualizado', 'El restaurante ha sido actualizado con éxito', 'success');
                    }
                });
            });
        });
    </script>
</body>
</html>
