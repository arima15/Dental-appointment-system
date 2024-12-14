document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggles = document.querySelectorAll('.sidebar-toggle');
    const body = document.body;

    sidebarToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            body.classList.toggle('sidebar-visible');

        });
    });
});
