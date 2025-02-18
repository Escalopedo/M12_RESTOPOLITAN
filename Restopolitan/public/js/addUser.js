document.addEventListener("DOMContentLoaded", function () {
    // Mostrar el formulario de añadir usuario
    document.getElementById('add-user-btn').addEventListener('click', function () {
        document.getElementById('add-user-form').style.display = 'block';
    });

    // Ocultar el formulario de añadir usuario
    document.getElementById('cancel-add-user').addEventListener('click', function () {
        document.getElementById('add-user-form').style.display = 'none';
    });

    // Enviar el formulario para crear un usuario
    document.getElementById('create-user-form').addEventListener('submit', function (event) {
        event.preventDefault();

        // Obtener los datos del formulario
        const name = document.getElementById('new-user-name').value;
        const email = document.getElementById('new-user-email').value;
        const password = document.getElementById('new-user-password').value;
        const roleId = document.getElementById('new-user-role').value;

        // Enviar la solicitud AJAX
        fetch('/users', {
            method: 'POST',
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
                Swal.fire('Creado', 'El usuario se ha creado con éxito.', 'success');

                // Agregar el usuario a la tabla sin recargar la página
                const userList = document.getElementById('user-list');
                const newRow = document.createElement('tr');
                newRow.id = 'user-' + data.user.id;
                newRow.innerHTML = `
                    <td>${data.user.id}</td>
                    <td>${data.user.name}</td>
                    <td>${data.user.email}</td>
                    <td>${data.role_name}</td>
                    <td>********</td>
                    <td>
                        <button class="btn btn-primary edit-user" data-id="${data.user.id}">Editar</button>
                        <button class="btn btn-danger delete-user" data-id="${data.user.id}">Eliminar</button>
                    </td>
                `;
                userList.appendChild(newRow);

                // Limpiar el formulario y ocultarlo
                document.getElementById('create-user-form').reset();
                document.getElementById('add-user-form').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error al crear el usuario:', error);
            Swal.fire('Error', 'Hubo un problema al crear el usuario.', 'error');
        });
    });
});
