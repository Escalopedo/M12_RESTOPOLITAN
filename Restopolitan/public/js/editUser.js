document.addEventListener("DOMContentLoaded", function () {

         // Función para editar un usuario
           document.querySelectorAll('.edit-user').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.dataset.id;
                fetch(`/users/${userId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('user-id').value = data.id;
                        document.getElementById('user-name').value = data.name;
                        document.getElementById('user-email').value = data.email;
                        document.getElementById('edit-user-form').style.display = 'block';
                    });
            });
        });

        // Función para cancelar la edición del usuario
        document.getElementById('cancel-edit-user').addEventListener('click', function () {
            document.getElementById('edit-user-form').style.display = 'none';
        });

        // Función para enviar el formulario de actualización del usuario
        document.getElementById('update-user-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const userId = document.getElementById('user-id').value;
            const name = document.getElementById('user-name').value;
            const email = document.getElementById('user-email').value;
            const password = document.getElementById('user-password').value;
            const roleId = document.getElementById('user-role').value; 

            fetch(`/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    password: password,
                    role_id: roleId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const userRow = document.getElementById(`user-${userId}`);
                    userRow.querySelector('td:nth-child(2)').textContent = name;
                    userRow.querySelector('td:nth-child(3)').textContent = email;

                    const roleName = data.role_name; // Asegúrate de que el backend devuelva el nombre del rol actualizado
                    userRow.querySelector('td:nth-child(4)').textContent = roleName;

                    const roleSelect = document.getElementById('user-role');
                    roleSelect.value = roleId; // Actualiza el valor del select al nuevo rol


                    document.getElementById('edit-user-form').style.display = 'none';
                    Swal.fire('Actualizado', 'El usuario ha sido actualizado con éxito', 'success');
                }
            });
        });
    });