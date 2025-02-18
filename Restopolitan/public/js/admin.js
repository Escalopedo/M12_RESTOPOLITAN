document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById('filter-restaurant-form');

    // Función para cargar restaurantes filtrados
    function loadFilteredRestaurants(filters = {}) {
        fetch('/restaurants/filter', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(filters)
        })
        .then(response => response.json())
        .then(data => {
            const restaurantList = document.getElementById('restaurant-list');
            restaurantList.innerHTML = ''; // Limpiar la lista actual

            data.forEach(restaurant => {
                const row = `
                    <tr id="restaurant-${restaurant.id}">
                        <td>${restaurant.id}</td>
                        <td>${restaurant.name}</td>
                        <td>${restaurant.description}</td>
                        <td>${restaurant.average_price}€</td>
                        <td>${restaurant.gerente ? restaurant.gerente.name : 'No asignado'}</td>
                        <td>${restaurant.location.street_address}</td>
                        <td>
                            <button class="btn btn-primary edit-restaurant" data-id="${restaurant.id}" data-bs-toggle="modal" data-bs-target="#editRestaurantModal">Editar</button>
                            <button class="btn btn-danger delete-restaurant" data-id="${restaurant.id}">Eliminar</button>
                        </td>
                    </tr>
                `;
                restaurantList.insertAdjacentHTML('beforeend', row);
            });
        });
    }

    // Escuchar cambios en los campos de filtrado
    filterForm.addEventListener('input', function () {
        const filters = {
            id: document.getElementById('filter-id').value.trim(),
            name: document.getElementById('filter-name').value.trim(),
            description: document.getElementById('filter-description').value.trim(),
            average_price: document.getElementById('filter-price').value.trim(),
            gerente: document.getElementById('filter-gerente').value.trim(),
            location: document.getElementById('filter-location').value.trim(), // Asegúrate de que este campo esté correctamente referenciado
        };
        loadFilteredRestaurants(filters);
    });

    // Cargar todos los restaurantes al inicio (opcional)
    loadFilteredRestaurants();
});