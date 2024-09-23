document.addEventListener('DOMContentLoaded', function () {
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl, {
      html: true, // Enable HTML content
    })
  })
});

async function setAsFound(event) {
  console.log(event.target);
  let id = event.target.getAttribute("data-person-id");
  console.log(id);

  const formData = new FormData(); // Create FormData object from the form
  formData.append('operation', 'mark_as_found'); // Append the operation parameter
  formData.append('firId', id);

  try {
    const response = await fetch('controller/controller.updateMissingJson.php', {
      method: 'POST',
      body: formData // Send FormData object
    });

    const result = await response.json(); // Parse the JSON response
    console.log(result);
    if (result.success) {
      window.location.reload();
    }
  } catch (error) {
    console.error('Error:', error);
    modalBody.innerHTML = 'An error occurred while saving data.';
    feedbackModal.show(); // Show the error modal
  }
}

async function deleteRecord(event) {
  console.log(event.target);
  let id = event.target.getAttribute("data-person-id");
  console.log(id);

  const formData = new FormData(); // Create FormData object from the form
  formData.append('operation', 'mark_as_delete'); // Append the operation parameter
  formData.append('firId', id);

  try {
    const response = await fetch('controller/controller.updateMissingJson.php', {
      method: 'POST',
      body: formData // Send FormData object
    });

    const result = await response.json(); // Parse the JSON response
    console.log(result);
    if (result.success) {
      window.location.reload();
    }
  } catch (error) {
    console.error('Error:', error);
    modalBody.innerHTML = 'An error occurred while saving data.';
    feedbackModal.show(); // Show the error modal
  }
}