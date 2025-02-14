/*1El usuario escribe en el input de búsqueda (home.blade.php).
2️AJAX (search.js) envía la petición a Laravel (/search?query=texto).
3️Laravel (web.php) recibe la petición y consulta la base de datos (Restaurant + Locations).
4️Laravel renderiza la vista parcial con los resultados (partials/restaurants.blade.php).
5️AJAX recibe la respuesta y actualiza dinámicamente la lista de restaurantes en home.blade.php.*/
document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById("search-input");
    let searchForm = document.getElementById("search-form");
    let restaurantsContainer = document.getElementById("restaurants-container");

    // Evitar que el formulario se envíe de forma tradicional
    searchForm.addEventListener("submit", function (event) {
        event.preventDefault();
    });

    // Escuchar los cambios en el input de búsqueda
    searchInput.addEventListener("keyup", function () {
        let query = searchInput.value;

        fetch(`/search?query=${query}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => response.text())
        .then(data => {
            restaurantsContainer.innerHTML = data;
        })
        .catch(error => console.error("Error en la búsqueda:", error));
    });
});