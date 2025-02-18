// ELIMINAR RESTAURANTE
document.querySelectorAll('.delete-restaurant').forEach(button => {
    button.addEventListener('click', function() {
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