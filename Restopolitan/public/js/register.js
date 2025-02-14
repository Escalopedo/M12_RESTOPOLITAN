// Selecciona el botón y el formulario
const showFormButton = document.getElementById('showFormButton');
const registrationForm = document.getElementById('registrationForm');

// Añade un evento de clic al botón
showFormButton.addEventListener('click', () => {
    // Oculta el botón
    showFormButton.classList.add('hidden');
    // Muestra el formulario
    registrationForm.classList.remove('hidden');
});

// Función para mostrar u ocultar errores
function mostrarError(input, mensajeError, mensaje) {
    mensajeError.style.color = 'red';
    mensajeError.textContent = mensaje;
    mensajeError.classList.add("active"); // Mostrar mensaje
}

function ocultarError(input, mensajeError) {
    mensajeError.textContent = '';
    mensajeError.classList.remove("active"); // Ocultar mensaje
}

// Validar Nombre
function validarNombre() {
    var nombre = document.getElementById('name');
    var mensajeError = document.getElementById('errorNombre');

    if (nombre.value === "") {
        mostrarError(nombre, mensajeError, 'El nombre no puede estar vacío');
        return false;
    } else if (/[^a-zA-ZáéíóúÁÉÍÓÚ\s]/.test(nombre.value)) {
        mostrarError(nombre, mensajeError, 'El nombre no puede contener números');
        return false;
    } else if (nombre.value.length < 3) {
        mostrarError(nombre, mensajeError, 'El nombre debe tener al menos 3 caracteres');
        return false;
    } else {
        ocultarError(nombre, mensajeError);
        return true;
    }
}

// Validar Correo
function validarCorreo() {
    var correo = document.getElementById('email');
    var mensajeError = document.getElementById('errorCorreo');
    var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (correo.value === "") {
        mostrarError(correo, mensajeError, 'El correo no puede estar vacío');
        return false;
    } else if (!regexCorreo.test(correo.value)) {
        mostrarError(correo, mensajeError, 'El correo no es válido');
        return false;
    } else {
        ocultarError(correo, mensajeError);
        return true;
    }
}

// Validar Contraseña
function validarContrasena() {
    var contrasena = document.getElementById('password');
    var mensajeError = document.getElementById('errorContra');

    if (contrasena.value === "") {
        mostrarError(contrasena, mensajeError, 'La contraseña no puede estar vacía');
        return false;
    } else if (contrasena.value.length < 8) {
        mostrarError(contrasena, mensajeError, 'La contraseña debe tener al menos 8 caracteres');
        return false;
    } else {
        ocultarError(contrasena, mensajeError);
        return true;
    }
}

// Validar Confirmar Contraseña
function validarConfirmarContrasena() {
    var confirmarContrasena = document.getElementById('password_confirmation');
    var mensajeError = document.getElementById('errorConfirmar');
    var contrasena = document.getElementById('password');

    if (confirmarContrasena.value === "") {
        mostrarError(confirmarContrasena, mensajeError, 'Por favor confirme la contraseña');
        return false;
    } else if (confirmarContrasena.value !== contrasena.value) {
        mostrarError(confirmarContrasena, mensajeError, 'Las contraseñas no coinciden');
        return false;
    } else {
        ocultarError(confirmarContrasena, mensajeError);
        return true;
    }
}

// Validar formulario al enviar
document.querySelector("form").addEventListener("submit", function(event) {
    var isValid = validarNombre() && validarCorreo() && validarContrasena() && validarConfirmarContrasena();
    if (!isValid) {
        event.preventDefault();
    }
});