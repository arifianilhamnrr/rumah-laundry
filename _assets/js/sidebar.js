/**
 * Sidebar Toggle Script
 * Clean, minimalist sidebar navigation
 */

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const toggleBtn = document.getElementById('mobile-menu-toggle');

    if (!sidebar || !overlay || !toggleBtn) return;

    // Toggle sidebar on mobile
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');

        // Change icon
        const icon = this.querySelector('i');
        if (sidebar.classList.contains('-translate-x-full')) {
            icon.className = 'fas fa-bars';
        } else {
            icon.className = 'fas fa-times';
        }
    });

    // Close sidebar when clicking overlay
    overlay.addEventListener('click', function() {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        toggleBtn.querySelector('i').className = 'fas fa-bars';
    });

    // Highlight active menu
    const currentPath = window.location.pathname;
    const menuLinks = sidebar.querySelectorAll('a');

    menuLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (currentPath.includes(href) && href !== '/') {
            link.classList.add('bg-primary-50', 'dark:bg-primary-900/20', 'text-primary-600', 'dark:text-primary-400');
            link.classList.remove('text-slate-700', 'dark:text-slate-200');
        }
    });
});
