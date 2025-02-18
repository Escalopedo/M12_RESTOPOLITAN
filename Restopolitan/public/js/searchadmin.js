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
        
        console.log("URL generada:", `/admin/users/filter?${params.toString()}`);

        console.log(`/admin/users/filter?${params.toString()}`);

        fetch(`/admin/users/filter?${params.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.text())
        .then(data => {
            userList.innerHTML = data;
        })
        .catch(error => console.error("Error en la búsqueda:", error));
    }

    userNameFilter.addEventListener("input", filterUsers);
    userEmailFilter.addEventListener("input", filterUsers);
    userRoleFilter.addEventListener("change", filterUsers);
});