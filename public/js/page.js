document.addEventListener('DOMContentLoaded', () => {
    const products = Array.from(document.querySelectorAll('.product-card'));
    const itemsPerPage = 6;
    let currentPage = 0;

    function displayProducts() {
        products.forEach((product, index) => {
            product.style.display = (index >= currentPage * itemsPerPage && index < (currentPage + 1) * itemsPerPage) ? 'block' : 'none';
        });

        document.getElementById('prevBtn').disabled = currentPage === 0;
        document.getElementById('nextBtn').disabled = currentPage >= Math.ceil(products.length / itemsPerPage) - 1;
    }

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            displayProducts();
        }
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        if (currentPage < Math.ceil(products.length / itemsPerPage) - 1) {
            currentPage++;
            displayProducts();
        }
    });

    displayProducts();
});
