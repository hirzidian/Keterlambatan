// Function to toggle theme and icon
function toggleTheme() {
    var htmlElement = document.querySelector('html');
    var currentTheme = htmlElement.getAttribute('data-bs-theme');
    var themeToggleIcon = document.querySelector('.theme-toggle i');

    // Toggle between 'white' and 'dark' themes
    var newTheme = (currentTheme === 'white') ? 'dark' : 'white';
    
    // Update the 'data-bs-theme' attribute
    htmlElement.setAttribute('data-bs-theme', newTheme);

    // Update the icon
    var newIconClass = (newTheme === 'white') ? 'fa-moon' : 'fa-sun';
    themeToggleIcon.className = 'fa-regular ' + newIconClass;

    // Save the current theme to local storage
    localStorage.setItem('theme', newTheme);
}

// Function to set the theme based on the stored value
function setTheme() {
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        var htmlElement = document.querySelector('html');
        var themeToggleIcon = document.querySelector('.theme-toggle i');

        // Update the 'data-bs-theme' attribute
        htmlElement.setAttribute('data-bs-theme', savedTheme);

        // Update the icon
        var savedIconClass = (savedTheme === 'white') ? 'fa-moon' : 'fa-sun';
        themeToggleIcon.className = 'fa-regular ' + savedIconClass;
    }
}   
const sidebarToggle = document.querySelector("#sidebar-toggle");
const sidebar = document.querySelector("#sidebar");

// Mendapatkan nilai dari localStorage saat halaman dimuat
const isSidebarCollapsed = localStorage.getItem("sidebarCollapsed") === "true";

// Setel kelas collapsed sesuai dengan nilai dari localStorage
sidebar.classList.toggle("collapsed", isSidebarCollapsed);

// Menambahkan event listener untuk tombol sidebar
sidebarToggle.addEventListener("click", function () {
    // Toggle kelas collapsed
    sidebar.classList.toggle("collapsed");

    // Simpan status ke localStorage
    localStorage.setItem("sidebarCollapsed", sidebar.classList.contains("collapsed"));
});

function isLight() {
    return localStorage.getItem("light");
}

if (isLight()) {
    toggleRootClass();
}
