function toggleMenu() {
    const menu = document.getElementById('menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

function showProfile() {
    document.getElementById('profileModal').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
}

function closeProfile() {
    document.getElementById('profileModal').style.display = 'none';
}

function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
}

window.onclick = function(e) {
    if (!e.target.closest('.hamburger-menu') && !e.target.closest('.menu-dropdown')) {
        document.getElementById('menu').style.display = 'none';
    }
}
