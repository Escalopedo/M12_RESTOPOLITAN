<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>



    <!-- SCRIPTS PARA CRUDS AJAX -->

    <script src="{{ asset('js/deleteRestaurant.js') }}" defer></script>
    <script src="{{ asset('js/editRestaurant.js') }}" defer></script>
    <script src="{{ asset('js/addRestaurant.js') }}" defer></script>

    <script src="{{ asset('js/addUser.js') }}" defer></script>
    <script src="{{ asset('js/editUser.js') }}" defer></script>
    <script src="{{ asset('js/deleteUser.js') }}" defer></script>

    <!-- FILTROS -->

    <script src="{{ asset('js/searchadmin.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>

</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Restopolitan Logo" class="logo">
            </a>
            <ul class="nav-links">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    <li><a href="{{ route('register') }}" class="subscribe-btn">¡REGÍSTRATE!</a></li>
                @endguest
                @auth
                    @if(Auth::user()->role && Auth::user()->role->name === 'Admin')
                        <li><a href="{{ route('home') }}" class="btn btn-outline-light">Home</a></li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}" id="logout-button" class="btn btn-danger">
                            Cerrar sesión
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </ul>            
        </div>
    </nav>

    <div class="container mt-5">
        <h1><strong>Panel de Administración</strong></h1>


        <button id="add-restaurant-btn" class="btn btn-success mb-3">RESTAURANTE NUEVO</button>

        <!-- Formulario para añadir un nuevo restaurante -->
        <div id="add-restaurant-form" class="mt-5" style="display:none;">
            <h3>Añadir Restaurante</h3>
            <form id="create-restaurant-form">
                <div class="mb-3">
                    <label for="new-name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="new-name" required>
                </div>
                <div class="mb-3">
                    <label for="new-description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="new-description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="new-average-price" class="form-label">Precio Promedio</label>
                    <input type="number" class="form-control" id="new-average-price" required>
                </div>
                <div class="mb-3">
                    <label for="new-gerente" class="form-label">Gerente</label>
                    <select class="form-control" id="new-gerente" required>
                        @foreach($gerentes as $gerente)
                            <option value="{{ $gerente->id }}">{{ $gerente->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="new-location" class="form-label">Ubicación</label>
                    <select class="form-control" id="new-location" required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->street_address }}, {{ $location->city }}, {{ $location->country }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Añadir Restaurante</button>
                <button type="button" id="cancel-add" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>

        <button id="add-user-btn" class="btn btn-success mb-3">Añadir Usuario</button>

        <!-- Formulario para añadir un nuevo usuario -->
        <div id="add-user-form" class="mt-5" style="display:none;">
            <h3>Añadir Usuario</h3>
            <form id="create-user-form">
                <div class="mb-3">
                    <label for="new-user-name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="new-user-name" required>
                </div>
                <div class="mb-3">
                    <label for="new-user-email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="new-user-email" required>
                </div>
                <div class="mb-3">
                    <label for="new-user-password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="new-user-password" required>
                </div>
                <div class="mb-3">
                    <label for="new-user-role" class="form-label">Rol</label>
                    <select class="form-control" id="new-user-role" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Añadir Usuario</button>
                <button type="button" id="cancel-add-user" class="btn btn-secondary">Cancelar</button>
            </form>
        </div>


        <h4><strong>Restaurantes</strong></h4>
        <div class="mb-3">
            <form id="filter-restaurant-form">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" id="filter-id" class="form-control" placeholder="ID">
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="filter-name" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="filter-description" class="form-control" placeholder="Descripción">
                    </div>
                    <div class="col-md-2">
                        <input type="number" id="filter-price" class="form-control" placeholder="Precio Promedio">
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="filter-gerente" class="form-control" placeholder="Gerente">
                    </div>
                    <div class="col-md-2">
                        <input type="text" id="filter-location" class="form-control" placeholder="Ubicación">
                    </div>
                </div>
            </form>
        </div>
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
                        <td>{{ $restaurant->gerente ? $restaurant->gerente ? $restaurant->gerente->name : 'No asignado' : 'No asignado'}}</td>
                        <td>{{ $restaurant->location->street_address }}</td>
                        <td>
                            <button class="btn btn-primary edit-restaurant" data-id="{{ $restaurant->id }}">Editar</button>
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
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="user-name-filter" class="form-control" placeholder="Filtrar por nombre...">
            </div>
            <div class="col-md-4">
                <input type="email" id="user-email-filter" class="form-control" placeholder="Filtrar por correo...">
            </div>
            <div class="col-md-4">
                <select id="user-role-filter" class="form-control">
                    <option value="">Todos los roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
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
            // ELIMINAR RESTAURANTE
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


    </script>
</body>
</html>