document.addEventListener("DOMContentLoaded", function () {
    let logoutButton = document.getElementById("logout-button");

    if (logoutButton) {
        logoutButton.addEventListener("click", function (event) {
            event.preventDefault();
            document.getElementById("logout-form").submit();
        });
    }
});