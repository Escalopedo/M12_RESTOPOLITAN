document.addEventListener("DOMContentLoaded", function () {
    let userNameFilter = document.getElementById("user-name-filter");
    let userEmailFilter = document.getElementById("user-email-filter");
    let userRoleFilter = document.getElementById("user-role-filter");
    let userList = document.getElementById("user-list");

    function filterUsers() {
        let params = new URLSearchParams();
        
        let name = userNameFilter.value.trim();
        let email = userEmailFilter.value.trim();
        let role = userRoleFilter.value.trim();

        if (name) params.append("name", name);
        if (email) params.append("email", email);
        if (role) params.append("role", role);

        fetch(`/admin/users/filter?${params.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then(data => {
            userList.innerHTML = data;
            attachUserEventListeners(); //Reasignar eventos después de actualizar la tabla
        })
        .catch(error => console.error("Error en la búsqueda:", error));
    }

    // Event listeners para filtrar
    userNameFilter.addEventListener("input", filterUsers);
    userEmailFilter.addEventListener("input", filterUsers);
    userRoleFilter.addEventListener("change", filterUsers);

    function attachUserEventListeners() {
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

        document.querySelectorAll('.edit-user').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.dataset.id;
                fetch(`/users/${userId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('user-id').value = data.id;
                        document.getElementById('user-name').value = data.name;
                        document.getElementById('user-email').value = data.email;
                        document.getElementById('user-role').value = data.role_id;
                        new bootstrap.Modal(document.getElementById('editUserModal')).show();
                    });
            });
        });
    }

    attachUserEventListeners(); //Asignar eventos al cargar la página
});