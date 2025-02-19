document.querySelectorAll('.edit-restaurant').forEach(button => {
    button.addEventListener('click', function() {
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
document.getElementById('update-restaurant-form').addEventListener('submit', function(event) {
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