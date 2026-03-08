function checkElement(id) {
    const element = document.getElementById(id);
    if (!element) {
        console.warn(`Element with id "${id}" not found.`);
    }
    return element;
}

const searchToggle = checkElement('search-toggle');
const themeToggle = checkElement('darkLight');
const toggleThemeButton = checkElement('toggleThemeButton');  // Ensure this exists in the HTML
const body = document.querySelector("body");
const darkLight = checkElement('darkLight');
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");
const sidebarOpen = document.querySelector("#sidebarOpen");
const sidebarClose = document.querySelector(".collapse_sidebar");
const sidebarExpand = document.querySelector(".expand_sidebar");
const searchInput = document.getElementById("search");
const display = document.getElementById("display");

// Toggle search bar display
searchToggle?.addEventListener('click', () => {
    const searchBar = document.querySelector('.search_bar');
    if (searchBar) searchBar.style.display = searchBar.style.display === 'block' ? 'none' : 'block';
});
searchInput.addEventListener("input", () => {
    const query = searchInput.value.trim();

    // Clear suggestions if query is empty
    if (!query) {
        display.innerHTML = "";
        display.style.display = "none";
        return;
    }

    // Fetch search results from the server
    fetch(`search.php?query=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(data => {
            display.innerHTML = "";
            display.style.display = "block";

            if (data.length > 0) {
                data.forEach(item => {
                    const suggestion = document.createElement("div");
                    suggestion.classList.add("suggestion-item");

                    // Set up display text and link based on result type
                    suggestion.innerHTML = `
                        <a href="${item.link}" class="suggestion-link">
                            ${item.name} (${item.type}) - ${item.year || ""}
                        </a>
                    `;

                    display.appendChild(suggestion);
                });
            } else {
                display.innerHTML = `<div class="no-results">No results found</div>`;
            }
        })
        .catch(error => {
            console.error("Error fetching search results:", error);
        });
});

// Hide dropdown when clicking outside
document.addEventListener("click", (event) => {
    if (!searchInput.contains(event.target) && !display.contains(event.target)) {
        display.style.display = "none";
    }
}); 

sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

sidebarClose.addEventListener("click", () => {
    sidebar.classList.add("close", "hoverable");
});
sidebarExpand.addEventListener("click", () => {
    sidebar.classList.remove("close", "hoverable");
});

sidebar.addEventListener("mouseenter", () => {
    if (sidebar.classList.contains("hoverable")) {
        sidebar.classList.remove("close");
    }
});
sidebar.addEventListener("mouseleave", () => {
    if (sidebar.classList.contains("hoverable")) {
        sidebar.classList.add("close");
    }
});
submenuItems.forEach((item, index) => {
    item.addEventListener("click", () => {
        item.classList.toggle("show_submenu");
        submenuItems.forEach((item2, index2) => {
            if (index !== index2) {
                item2.classList.remove("show_submenu");
            }
        });
    });
});

// Theme toggle
darkLight?.addEventListener("click", () => {
    body.classList.toggle("dark");
});
themeToggle?.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    themeToggle.classList.toggle("bx-sun");
    themeToggle.classList.toggle("bx-moon");

    // Update the theme based on the current class
    if (body.classList.contains('dark-mode')) {
        // Dark mode styles
        body.style.backgroundColor = '#121212'; // Example dark background
        body.style.color = '#FFFFFF'; // Example light text
        toggleThemeButton?.classList.remove('icon-light');
        toggleThemeButton?.classList.add('icon-dark');
    } else {
        // Light mode styles
        body.style.backgroundColor = '#FFFFFF'; // Example light background
        body.style.color = '#000000'; // Example dark text
        toggleThemeButton?.classList.remove('icon-dark');
        toggleThemeButton?.classList.add('icon-light');
    }
});
