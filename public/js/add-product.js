document.addEventListener('DOMContentLoaded', () => {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Function to navigate to the previous or next page
    const navigateToPage = (page) => {
        window.location.href = `/products?page=${page}`;
    };

    // Event listeners for the navigation buttons
    prevBtn?.addEventListener('click', () => {
        navigateToPage(prevBtn.getAttribute('data-page'));
    });

    nextBtn?.addEventListener('click', () => {
        navigateToPage(nextBtn.getAttribute('data-page'));
    });
});
