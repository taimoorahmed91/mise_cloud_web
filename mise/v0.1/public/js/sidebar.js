// sidebar.js
document.addEventListener("DOMContentLoaded", function () {
    // Check if sidebar state exists in Local Storage
    const sidebarState = localStorage.getItem("sidebarState");

    // If state exists, apply it to the sidebar
    if (sidebarState) {
        const sidebar = document.getElementById("rootSidebar");
        sidebar.innerHTML = sidebarState;
    }

    // Save the sidebar state when a drawer is opened or closed
    const drawers = document.querySelectorAll(".sidebar__drawer");
    drawers.forEach(function (drawer) {
        drawer.addEventListener("click", function () {
            localStorage.setItem("sidebarState", document.getElementById("rootSidebar").innerHTML);
        });
    });
});
