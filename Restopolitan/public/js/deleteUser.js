document.addEventListener("DOMContentLoaded", function () {

    // Función para eliminar un usuario
    document.querySelectorAll('.delete-user').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.dataset.id;
            Swal.fire({
                title: "¿Quieres eliminar este usuario?",
                text: "¡No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Eliminado', 'El usuario ha sido eliminado', 'success');
                            document.getElementById(`user-${userId}`).remove();
                        }
                    });
                }
            });
        });
    });

});