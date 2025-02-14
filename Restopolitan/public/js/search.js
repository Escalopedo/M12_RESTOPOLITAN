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