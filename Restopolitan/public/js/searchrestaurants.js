document.addEventListener("DOMContentLoaded", function () {
    let nameFilter = document.getElementById("restaurant-name-filter");
    let minPriceFilter = document.getElementById("min_price");
    let maxPriceFilter = document.getElementById("max_price");
    let gerenteFilter = document.getElementById("restaurant-gerente-filter");
    let locationFilter = document.getElementById("restaurant-location-filter");
    let restaurantList = document.getElementById("restaurant-list");

    function filterRestaurants() {
        let params = new URLSearchParams();

        let name = nameFilter.value.trim();
        let minPrice = minPriceFilter.value.trim();
        let maxPrice = maxPriceFilter.value.trim();
        let gerente = gerenteFilter.value.trim();
        let location = locationFilter.value.trim();

        if (name) params.append("name", name);
        if (minPrice) params.append("min_price", minPrice);
        if (maxPrice) params.append("max_price", maxPrice);
        if (gerente) params.append("gerente", gerente);
        if (location) params.append("location", location);

        fetch(`/admin/restaurants/filter?${params.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then(data => {
            restaurantList.innerHTML = data;
        })
        .catch(error => console.error("Error en la búsqueda:", error));
    }

    nameFilter.addEventListener("input", filterRestaurants);
    minPriceFilter.addEventListener("input", filterRestaurants);
    maxPriceFilter.addEventListener("input", filterRestaurants);
    gerenteFilter.addEventListener("input", filterRestaurants);
    locationFilter.addEventListener("input", filterRestaurants);
});