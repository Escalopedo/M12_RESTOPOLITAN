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
                    <th>Gerente</th>
                    <th>Ubicación</th>
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
                        <td>{{ $restaurant->gerente->name }}</td>
                        <td>{{ $restaurant->location->street_address }}</td>
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

                <div class="mb-3">
                    <label for="gerente" class="form-label">Gerente</label>
                        <select class="form-control" id="gerente" required>
                            @foreach($gerentes as $gerente)
                                <option value="{{ $gerente->id }}">{{ $gerente->name }}</option>
                            @endforeach
                        </select>
                </div>

                <!-- Select para Ubicación -->
                <div class="mb-3">
                    <label for="location" class="form-label">Ubicación</label>
                        <select class="form-control" id="location" required>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->street_address }}, {{ $location->city }}, {{ $location->country }}</option>
                            @endforeach
                        </select>
                </div>

                <button type="submit" class="btn btn-success">Actualizar Restaurante</button>
                <button type="button" id="cancel-edit" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>

        <!-- Listado de Usuarios -->
        <h3>Usuarios</h3>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Contraseña</th>
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
                        <td>{{ $user->password }}</td>
                        <td>
                            <button class="btn btn-primary edit-user" data-id="{{ $user->id }}">Editar</button>
                            <button class="btn btn-danger delete-user" data-id="{{ $user->id }}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Formulario para editar un usuario -->
        <div id="edit-user-form" class="mt-5" style="display:none;">
            <h3>Editar Usuario</h3>
            <form id="update-user-form">
                <input type="hidden" id="user-id">
                <div class="mb-3">
                    <label for="user-name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="user-name" required>
                </div>
                <div class="mb-3">
                    <label for="user-email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="user-email" required>
                </div>
                <div class="mb-3">
                    <label for="user-role" class="form-label">Rol</label>
                    <select class="form-control" id="user-role" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="user-password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="user-password">
                </div>
                <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                <button type="button" id="cancel-edit-user" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        
        // RESTAURANTES

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
                            document.getElementById('restaurant-id').value = data.id;
                            document.getElementById('name').value = data.name;
                            document.getElementById('description').value = data.description;
                            document.getElementById('average_price').value = data.average_price;
                            document.getElementById('gerente').value = data.gerente_id;
                            document.getElementById('location').value = data.location_id;
                            document.getElementById('edit-restaurant-form').style.display = 'block';
                        });
                });
            });

            // Función para cancelar la edición del restaurante
            document.getElementById('cancel-edit').addEventListener('click', function () {
                document.getElementById('edit-restaurant-form').style.display = 'none';
            });

            // Función para enviar el formulario de actualización del restaurante
            document.getElementById('update-restaurant-form').addEventListener('submit', function (event) {
                event.preventDefault();

                const restaurantId = document.getElementById('restaurant-id').value;
                const name = document.getElementById('name').value;
                const description = document.getElementById('description').value;
                const average_price = document.getElementById('average_price').value;
                const gerente_id = document.getElementById('gerente').value;
                const location_id = document.getElementById('location').value;

                fetch(`/restaurants/${restaurantId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: name,
                        description: description,
                        average_price: average_price,
                        gerente_id: gerente_id,
                        location_id: location_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const restaurantRow = document.getElementById(`restaurant-${restaurantId}`);
                        restaurantRow.querySelector('td:nth-child(2)').textContent = name;
                        restaurantRow.querySelector('td:nth-child(3)').textContent = description;
                        restaurantRow.querySelector('td:nth-child(4)').textContent = `${average_price}€`;
                        restaurantRow.querySelector('td:nth-child(5)').textContent = document.getElementById('gerente').selectedOptions[0].text; // Mostrar el gerente actualizado
                        restaurantRow.querySelector('td:nth-child(6)').textContent = document.getElementById('location').selectedOptions[0].text; // Mostrar la ubicación actualizada

                        document.getElementById('edit-restaurant-form').style.display = 'none';
                        Swal.fire('Actualizado', 'El restaurante ha sido actualizado con éxito', 'success');
                    }
                });
            });

            // USUARIOS

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
                            document.getElementById('user-id').value = data.id;
                            document.getElementById('user-name').value = data.name;
                            document.getElementById('user-email').value = data.email;
                            document.getElementById('edit-user-form').style.display = 'block';
                        });
                });
            });

            // Función para cancelar la edición del usuario
            document.getElementById('cancel-edit-user').addEventListener('click', function () {
                document.getElementById('edit-user-form').style.display = 'none';
            });

            // Función para enviar el formulario de actualización del usuario
            document.getElementById('update-user-form').addEventListener('submit', function (event) {
                event.preventDefault();

                const userId = document.getElementById('user-id').value;
                const name = document.getElementById('user-name').value;
                const email = document.getElementById('user-email').value;
                const password = document.getElementById('user-password').value;
                const roleId = document.getElementById('user-role').value; 

                fetch(`/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        password: password,
                        role_id: roleId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const userRow = document.getElementById(`user-${userId}`);
                        userRow.querySelector('td:nth-child(2)').textContent = name;
                        userRow.querySelector('td:nth-child(3)').textContent = email;

                        const roleName = data.role_name; // Asegúrate de que el backend devuelva el nombre del rol actualizado
                        userRow.querySelector('td:nth-child(4)').textContent = roleName;

                        const roleSelect = document.getElementById('user-role');
                        roleSelect.value = roleId; // Actualiza el valor del select al nuevo rol


                        document.getElementById('edit-user-form').style.display = 'none';
                        Swal.fire('Actualizado', 'El usuario ha sido actualizado con éxito', 'success');
                    }
                });
            });
        });
    </script>
</body>
</html>