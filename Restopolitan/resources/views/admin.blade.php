<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
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

    <div class="container mt-5">
        <h1><strong>Panel de Administración</strong></h1>

        <!-- Listado de Restaurantes -->
        <h4><strong>Restaurantes</strong></h4>
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
                            <button class="btn btn-primary edit-restaurant" data-id="{{ $restaurant->id }}" data-bs-toggle="modal" data-bs-target="#editRestaurantModal">Editar</button>
                            <button class="btn btn-danger delete-restaurant" data-id="{{ $restaurant->id }}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal para Editar Restaurante -->
        <div class="modal fade" id="editRestaurantModal" tabindex="-1" aria-labelledby="editRestaurantModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRestaurantModalLabel">Editar Restaurante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
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
                            <div class="mb-3">
                                <label for="location" class="form-label">Ubicación</label>
                                <select class="form-control" id="location" required>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->street_address }}, {{ $location->city }}, {{ $location->country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar Restaurante</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h4><strong>Usuarios</strong></h4>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Contraseña</th>
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
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->role->name ?? 'No asignado' }}</td>
                        <td>
                            <button class="btn btn-primary edit-user" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#editUserModal">Editar</button>
                            <button class="btn btn-danger delete-user" data-id="{{ $user->id }}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal para Editar Usuario -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
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
                                <label for="user-password" class="form-label">Nueva Contraseña (opcional)</label>
                                <input type="password" class="form-control" id="user-password">
                            </div>
                            <button type="submit" class="btn btn-success">Actualizar Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // EDITAR RESTAURANTE - Abrir modal con datos
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
                                new bootstrap.Modal(document.getElementById('editRestaurantModal')).show();
                            });
                    });
                });

                // ACTUALIZAR RESTAURANTE
                document.getElementById('update-restaurant-form').addEventListener('submit', function (event) {
                    event.preventDefault();
                    const restaurantId = document.getElementById('restaurant-id').value;
                    fetch(`/restaurants/${restaurantId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: document.getElementById('name').value,
                            description: document.getElementById('description').value,
                            average_price: document.getElementById('average_price').value,
                            gerente_id: document.getElementById('gerente').value,
                            location_id: document.getElementById('location').value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('editRestaurantModal').querySelector('.btn-close').click();
                            Swal.fire({
                                title: "Actualizado",
                                text: "El restaurante ha sido actualizado con éxito",
                                icon: "success",
                                confirmButtonText: "Aceptar",
                                allowOutsideClick: false
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                });

                // EDITAR USUARIO - Abrir modal con datos
                document.querySelectorAll('.edit-user').forEach(button => {
                    button.addEventListener('click', function () {
                        const userId = this.dataset.id;
                        fetch(`/users/${userId}/edit`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('user-id').value = data.id;
                                document.getElementById('user-name').value = data.name;
                                document.getElementById('user-email').value = data.email;
                                document.getElementById('user-role').value = data.role_id;
                                new bootstrap.Modal(document.getElementById('editUserModal')).show();
                            });
                    });
                });

                // ACTUALIZAR USUARIO
                document.getElementById('update-user-form').addEventListener('submit', function (event) {
                    event.preventDefault();
                    const userId = document.getElementById('user-id').value;
                    const password = document.getElementById('user-password').value.trim();

                    fetch(`/users/${userId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            name: document.getElementById('user-name').value,
                            email: document.getElementById('user-email').value,
                            role_id: document.getElementById('user-role').value,
                            password: password ? password : undefined
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('editUserModal').querySelector('.btn-close').click();
                            Swal.fire({
                                title: "Actualizado",
                                text: "El usuario ha sido actualizado con éxito",
                                icon: "success",
                                confirmButtonText: "Aceptar",
                                allowOutsideClick: false
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });
                });
            });
        </script>
    </div>
</body>
</html>
