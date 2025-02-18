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