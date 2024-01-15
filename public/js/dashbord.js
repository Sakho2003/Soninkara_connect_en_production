document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.querySelector('.main-sidebar');
    const openSidebar = document.querySelector('#openSidebar');
    const closeSidebar = document.querySelector('#closeSidebar');

    if (openSidebar) {
        openSidebar.addEventListener('click', openSidebarFunction);
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarFunction);
    }

    function openSidebarFunction() {
        sidebar.style.left = '0%';
    }

    function closeSidebarFunction() {
        sidebar.style.left = '-100%';
    }

    const insightsSection = document.querySelector('.insights');

    if (insightsSection) {
        insightsSection.style.display = 'none';

        function toggleInsightsSection() {
            const currentPath = window.location.pathname;
            const isColisPage = currentPath.includes('/colis');
            insightsSection.style.display = isColisPage ? 'none' : 'block';
        }

        toggleInsightsSection();

        window.addEventListener('popstate', toggleInsightsSection);
    }
});
