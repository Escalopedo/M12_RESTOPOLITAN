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
    
        <script src="{{ asset('js/addRestaurant.js') }}" defer></script>
        <script src="{{ asset('js/editRestaurant.js') }}" defer></script>
        <script src="{{ asset('js/deleteRestaurant.js') }}" defer></script>
    
    
        <script src="{{ asset('js/addUser.js') }}" defer></script>
        <script src="{{ asset('js/editUser.js') }}" defer></script>
        <script src="{{ asset('js/deleteUser.js') }}" defer></script>
    
        <!-- FILTROS -->
    
        <script src="{{ asset('js/searchadmin.js') }}" defer></script>
        <script src="{{ asset('js/searchrestaurants.js') }}" defer></script>
    
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

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                    </a>
                @endauth
            </ul>            
        </div>
    </nav>

    <div class="container mt-5">
        <h1><strong>Panel de Administración</strong></h1>

        <div class="d-flex justify-content-end">
            <button id="add-restaurant-btn" class="btn btn-success mb-3">RESTAURANTE NUEVO</button>
            <button id="add-user-btn" class="btn btn-success mb-3 ms-2">USUARIO NUEVO</button>
        </div>

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
                    <input type="number" class="form-control" id="new-average-price" step="0.01" required>
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
        <div class="row mb-3">
            <div class="col-md-2">
                <input type="text" id="restaurant-name-filter" class="form-control" placeholder="Filtrar por nombre...">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="min_price" placeholder="Precio Mínimo">
            </div>
            <div class="col-md-2">
                <input type="number" class="form-control" id="max_price" placeholder="Precio Máximo">
            </div>
            <div class="col-md-2">
                <input type="text" id="restaurant-gerente-filter" class="form-control" placeholder="Filtrar por gerente...">
            </div>
            <div class="col-md-2">
                <input type="text" id="restaurant-location-filter" class="form-control" placeholder="Filtrar por ubicación...">
            </div>
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
                        <td>{{ $restaurant->gerente ? $restaurant->gerente->name : 'No asignado'}}</td>
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
                        <input type="number" class="form-control" id="average_price" step="0.01" required>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>