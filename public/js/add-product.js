document.addEventListener('DOMContentLoaded', () => {
    const addProductForm = document.getElementById('addProductForm');
    const imageOption = document.getElementById('imageOption');
    const uploadImageField = document.getElementById('uploadImageField');
    const productImage = document.getElementById('productImage');

    // Show or hide the image upload field based on the selected option
    imageOption.addEventListener('change', () => {
        if (imageOption.value === 'upload') {
            uploadImageField.style.display = 'block';
            productImage.disabled = false;  // Enable the file input
        } else {
            uploadImageField.style.display = 'none';
            productImage.disabled = true;  // Disable the file input
        }
    });

    // Handle form submission
    addProductForm.onsubmit = async (event) => {
        event.preventDefault();

        const formData = new FormData(addProductForm);

        // If the user selects the 'default' image option, remove the image field from the form data
        if (imageOption.value === 'default') {
            formData.delete('image');
        }

        try {
            const response = await fetch(addProductForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: formData,
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error('Server Error:', errorText);
                alert(`Failed to add product: Server responded with ${response.status}`);
                return;
            }

            let data;
            try {
                data = await response.json();
            } catch (parseError) {
                console.error('JSON Parse Error:', parseError);
                alert('Failed to parse server response. Please check the console for details.');
                return;
            }

            if (data.success) {
                alert('Product added successfully!');
                window.location.href = '/products';
            } else {
                alert(`Failed to add product: ${data.message || 'Unknown error'}`);
                console.error('Server Error:', data);
            }
        } catch (error) {
            console.error('Fetch Error:', error);
            alert('An unexpected error occurred. Please check the console for details.');
        }
    };
});


document.addEventListener('DOMContentLoaded', () => {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // Function to navigate to the previous page
    const navigateToPage = (page) => {
        window.location.href = `/products?page=${page}`;
    };

    // Event listeners for the navigation buttons
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            const page = prevBtn.getAttribute('data-page');
            navigateToPage(page);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            const page = nextBtn.getAttribute('data-page');
            navigateToPage(page);
        });
    }
});
