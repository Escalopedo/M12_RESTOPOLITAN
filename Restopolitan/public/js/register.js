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