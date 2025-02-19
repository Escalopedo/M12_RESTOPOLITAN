document.addEventListener('DOMContentLoaded', function() {
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

    // ACTUALIZAR USUARIO
    document.getElementById('update-user-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const userId = document.getElementById('user-id').value;
        const password = document.getElementById('user-password').value.trim();

        fetch(`/users/${userId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                name: document.getElementById('user-name').value,
                email: document.getElementById('user-email').value,
                role_id: document.getElementById('user-role').value,
                password: password ? password : undefined
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('editUserModal').querySelector('.btn-close').click();
                Swal.fire({
                    title: "Actualizado",
                    text: "El usuario ha sido actualizado con éxito",
                    icon: "success",
                    confirmButtonText: "Aceptar",
                    allowOutsideClick: false
                }).then(() => {
                    location.reload();
                });
            }
        });
    });
});
