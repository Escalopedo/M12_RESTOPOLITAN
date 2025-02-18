document.addEventListener("DOMContentLoaded", function () {
    // Función para eliminar un restaurante
    document.querySelectorAll('.delete-restaurant').forEach(button => {
        button.addEventListener('click', function () {
            const restaurantId = this.dataset.id; // Obtén el ID del restaurante
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
                    // Realiza la solicitud DELETE para eliminar el restaurante
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
                            // Muestra un mensaje de éxito
                            Swal.fire('Eliminado', 'El restaurante ha sido eliminado', 'success');
                            // Elimina el restaurante de la interfaz de usuario
                            document.getElementById(`restaurant-${restaurantId}`).remove();
                        } else {
                            // Si algo salió mal, muestra un error
                            Swal.fire('Error', 'No se pudo eliminar el restaurante', 'error');
                        }
                    });
                }
            });
        });
    });
});
