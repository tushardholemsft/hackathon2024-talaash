document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('data-form'); // Select the form element
    const uploadForm = document.getElementById('upload-form');
    const feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal')); // Initialize modal
    const modalBody = document.getElementById('modal-body-content'); // Select modal body

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(form); // Create FormData object from the form
        formData.append('operation', 'add_data_through_form'); // Append the operation parameter

        try {
            const response = await fetch('controller/controller.updateMissingJson.php', {
                method: 'POST',
                body: formData // Send FormData object
            });

            const result = await response.json(); // Parse the JSON response

            // Set modal content
            if (response.ok) {
                modalBody.innerHTML = result.message || 'Data saved successfully!';
                feedbackModal.show(); // Show the success modal
                form.reset(); // Reset form after successful submission
            } else {
                modalBody.innerHTML = result.message || 'Failed to save data.';
                feedbackModal.show(); // Show the error modal
            }
        } catch (error) {
            console.error('Error:', error);
            modalBody.innerHTML = 'An error occurred while saving data.';
            feedbackModal.show(); // Show the error modal
        }
    });


    uploadForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(uploadForm); // Create FormData object from the upload form
        formData.append('operation', 'import_data_through_json'); // Append the operation parameter

        try {
            const response = await fetch('controller/controller.updateMissingJson.php', {
                method: 'POST',
                body: formData // Send FormData object
            });

            const result = await response.json(); // Parse the JSON response

            // Set modal content
            if (response.ok) {
                modalBody.innerHTML = result.message || 'File uploaded and processed successfully!';
                feedbackModal.show(); // Show the success modal
                uploadForm.reset(); // Reset form after successful upload
            } else {
                modalBody.innerHTML = result.message || 'Failed to process the file.';
                feedbackModal.show(); // Show the error modal
            }
        } catch (error) {
            console.error('Error:', error);
            modalBody.innerHTML = 'An error occurred while uploading the file.';
            feedbackModal.show(); // Show the error modal
        }
    });
});