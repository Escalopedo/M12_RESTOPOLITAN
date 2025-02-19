document.addEventListener("DOMContentLoaded", function () {
    let nameFilter = document.getElementById("restaurant-name-filter");
    let minPriceFilter = document.getElementById("min_price");
    let maxPriceFilter = document.getElementById("max_price");
    let gerenteFilter = document.getElementById("restaurant-gerente-filter");
    let locationFilter = document.getElementById("restaurant-location-filter");
    let restaurantList = document.getElementById("restaurant-list");

    function filterRestaurants() {
        let params = new URLSearchParams();

        let name = nameFilter.value.trim();
        let minPrice = minPriceFilter.value.trim();
        let maxPrice = maxPriceFilter.value.trim();
        let gerente = gerenteFilter.value.trim();
        let location = locationFilter.value.trim();

        if (name) params.append("name", name);
        if (minPrice) params.append("min_price", minPrice);
        if (maxPrice) params.append("max_price", maxPrice);
        if (gerente) params.append("gerente", gerente);
        if (location) params.append("location", location);

        fetch(`/admin/restaurants/filter?${params.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then(data => {
            restaurantList.innerHTML = data;
            attachEventListeners();  //Reasignar eventos después de actualizar la tabla
        })
        .catch(error => console.error("Error en la búsqueda:", error));
    }

    // Event listeners para filtrar
    nameFilter.addEventListener("input", filterRestaurants);
    minPriceFilter.addEventListener("input", filterRestaurants);
    maxPriceFilter.addEventListener("input", filterRestaurants);
    gerenteFilter.addEventListener("input", filterRestaurants);
    locationFilter.addEventListener("input", filterRestaurants);

    function attachEventListeners() {
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
    }

    attachEventListeners(); //Asignar eventos al cargar la página
});