function toggleSubmenu(submenuId) {
    var submenu = document.getElementById(submenuId);
    if (submenu.style.display === "none") {
        submenu.style.display = "block";
    } else {
        submenu.style.display = "none";
    }
}
