document.getElementById('missingPersonForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Get form data
    const firstName = document.getElementById("first_name").value;
    const lastName = document.getElementById("last_name").value;
    var name = firstName + " " + lastName;;
    var age = document.getElementById('age').value;
    var gender = document.getElementById('gender').value;
    var location = document.getElementById('location').value;
    var description = document.getElementById('description').value;

    // Construct toast content
    var toastContent = `
        <p><strong>Name:</strong> ${name}</p>
        <p><strong>Age:</strong> ${age}</p>
        <p><strong>Gender:</strong> ${gender}</p>
        <p><strong>Last Seen Location:</strong> ${location}</p>
        <p><strong>Description:</strong> ${description}</p>
    `;
    document.getElementById('toastContent').innerHTML = toastContent;

    // Show toast
    var toast = new bootstrap.Toast(document.getElementById('toast'));
    toast.show();

    // Redirect after 5 seconds
    setTimeout(function () {
        window.location.href = './index.html'; // Replace with your target URL
    }, 3000);
});