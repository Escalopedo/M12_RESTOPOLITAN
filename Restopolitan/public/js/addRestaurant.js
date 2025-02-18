            
            // AÑADIR RESTAURANTE 

            document.getElementById('add-restaurant-btn').addEventListener('click', function () {
                document.getElementById('add-restaurant-form').style.display = 'block';
            });

            document.getElementById('cancel-add').addEventListener('click', function () {
                document.getElementById('add-restaurant-form').style.display = 'none';
            });

            document.getElementById('create-restaurant-form').addEventListener('submit', function (event) {
                event.preventDefault(); // Evita el envío del formulario tradicional

                // Obtener los datos del formulario
                const name = document.getElementById('new-name').value;
                const description = document.getElementById('new-description').value;
                const average_price = document.getElementById('new-average-price').value;
                const gerente_id = document.getElementById('new-gerente').value;
                const location_id = document.getElementById('new-location').value;

                // Enviar la solicitud AJAX para crear un nuevo restaurante
                fetch('/restaurants', {
                    method: 'POST',
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
                        Swal.fire('Creado', 'El restaurante se ha creado con éxito.', 'success');
                        // Agregar el restaurante a la tabla sin recargar la página
                        const restaurantList = document.getElementById('restaurant-list');
                        const newRow = document.createElement('tr');
                        newRow.id = 'restaurant-' + data.restaurant.id;
                        newRow.innerHTML = `
                            <td>${data.restaurant.id}</td>
                            <td>${data.restaurant.name}</td>
                            <td>${data.restaurant.description}</td>
                            <td>${data.restaurant.average_price}€</td>
                            <td>${data.restaurant.gerente.name}</td>
                            <td>${data.restaurant.location.street_address}</td>
                            <td>
                                <button class="btn btn-primary edit-restaurant" data-id="${data.restaurant.id}">Editar</button>
                                <button class="btn btn-danger delete-restaurant" data-id="${data.restaurant.id}">Eliminar</button>
                            </td>
                        `;
                        restaurantList.appendChild(newRow);

                        // Limpiar el formulario y ocultarlo
                        document.getElementById('create-restaurant-form').reset();
                        document.getElementById('add-restaurant-form').style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error al crear el restaurante:', error);
                    Swal.fire('Error', 'Hubo un problema al crear el restaurante.', 'error');
                });
            });

            