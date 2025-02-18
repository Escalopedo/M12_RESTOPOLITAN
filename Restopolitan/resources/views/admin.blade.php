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

        <!-- Listado de Usuarios -->
        <h3>Usuarios</h3>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="user-list">
                @foreach($users as $user)
                    <tr id="user-{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name ?? 'No asignado' }}</td>
                        <td>
                            <button class="btn btn-primary edit-user" data-id="{{ $user->id }}">Editar</button>
                            <button class="btn btn-danger delete-user" data-id="{{ $user->id }}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
                            // Aquí puedes llenar un formulario para editar el restaurante
                            console.log(data); // Los datos del restaurante para editar
                        });
                });
            });

            // Función para eliminar un usuario
            document.querySelectorAll('.delete-user').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.id;
                    Swal.fire({
                        title: "¿Quieres eliminar este usuario?",
                        text: "¡No podrás revertir esta acción!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/users/${userId}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Eliminado', 'El usuario ha sido eliminado', 'success');
                                    document.getElementById(`user-${userId}`).remove();
                                }
                            });
                        }
                    });
                });
            });

            // Función para editar un usuario
            document.querySelectorAll('.edit-user').forEach(button => {
                button.addEventListener('click', function () {
                    const userId = this.dataset.id;
                    fetch(`/users/${userId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            // Aquí puedes llenar un formulario para editar el usuario
                            console.log(data); // Los datos del usuario para editar
                        });
                });
            });
        });
    </script>
</body>
</html>
