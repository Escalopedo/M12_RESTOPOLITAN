/*1El usuario escribe en el input de búsqueda (home.blade.php).
2️AJAX (search.js) envía la petición a Laravel (/search?query=texto).
3️Laravel (web.php) recibe la petición y consulta la base de datos (Restaurant + Locations).
4️Laravel renderiza la vista parcial con los resultados (partials/restaurants.blade.php).
5️AJAX recibe la respuesta y actualiza dinámicamente la lista de restaurantes en home.blade.php.*/

document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById("search-input");
    let cuisineSelector = document.getElementById("cuisine-selector");
    let ratingSelector = document.getElementById("rating-selector");
    let restaurantsContainer = document.getElementById("restaurants-container");

    function performSearch() {
        let params = new URLSearchParams();

        // Obtener valores de búsqueda
        let name = searchInput.value.trim();
        let cuisine = cuisineSelector.value.trim();
        let rating = ratingSelector.value.trim();

        // Agregar parámetros solo si tienen valores
        if (name) params.append("name", name);
        if (cuisine) params.append("cuisine", cuisine);
        if (rating) params.append("min_rating", rating);
        console.log(`/search?${params.toString()}`);

        // Realizar la solicitud AJAX
        fetch(`/search?${params.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then(data => {
            restaurantsContainer.innerHTML = data;
        })
        .catch(error => console.error("Error en la búsqueda:", error));
    }

    // Escuchar cambios en el campo de búsqueda y el menú desplegable
    searchInput.addEventListener("keyup", performSearch);
    cuisineSelector.addEventListener("change", performSearch);
    ratingSelector.addEventListener("change", performSearch);
});