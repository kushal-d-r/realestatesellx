function toggleMenu() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("active");
}

// Close sidebar if clicked outside
document.addEventListener("click", function(event) {
    const sidebar = document.getElementById("sidebar");
    const hamburger = document.querySelector(".hamburger");

    if (!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
        sidebar.classList.remove("active");
    }
});

function addToFavorites(propertyId, button) {
    let formData = new FormData();
    formData.append("property_id", propertyId);

    fetch("add_favorite.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("Success")) {
            button.textContent = "✔ Added";
            button.disabled = true;
        }
    })
    .catch(error => console.error("Error:", error));
}


