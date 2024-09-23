<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALAASH</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Teko:wght@300..700&display=swap"
        rel="stylesheet">
    <!-- AOS CSS for animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./media/css/index.css">
    <style>
        .container-fluid {
            overflow:auto;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="index.html">
                    <img src="./media/images/logo.png" alt="TALASH Logo" id="logo"
                        class="d-inline-block align-text-top">
                </a>

                <!-- Toggler for small screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto nav-underline">
                        <li class="nav-item how-to-use">
                            <a class="nav-link active" aria-current="page" href="./upload.php">Submit Case</a>
                        </li>
                        <li class="nav-item how-to-use">
                            <a class="nav-link" href="./all-missing-records.php">Unidentified Cases</a>
                        </li>
                        <li class="nav-item how-to-use">
                            <a class="nav-link" href="./all-found-records.php">Identified Cases</a>
                        </li>
                        <li class="nav-item notification">
                            <i class="bi bi-bell" data-bs-toggle="popover" data-bs-placement="bottom"
                                title="Notifications" data-bs-content="
                              <div class='d-flex align-items-center mb-2'>
                                <div>
                                  <p class='mb-0'>New Match Found for FIR Number:FIR98765 </p>
                                  <small class='text-muted'>2 minutes ago</small>
                                </div>
                              </div>
                              <!-- More notification items can be added here -->
                            "></i>
                        </li>

                        <li class="nav-item">
                            <a class="btn btn-primary login-btn" href="./login.html" role="button">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>

        <div class="container mt-5" id="add-missing-person-report">
    <!-- Form Section: Complete Form -->
    <fieldset class="border rounded-3 mx-5 px-4 pb-4">
        <legend class="custom-legend">Missing Person Details</legend>
        <div class="card-body">
            <form method="POST" id="data-form">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mark" class="form-label">Identifying Mark</label>
                        <input type="text" class="form-control" id="mark" name="mark" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pincode" class="form-label">Pin Code</label>
                        <input type="text" class="form-control" id="pincode" name="pincode" required>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fir_number" class="form-label">FIR Number</label>
                        <input type="text" class="form-control" id="fir_number" name="FIR_number" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="contact_details" class="form-label">Contact Details</label>
                        <input type="text" class="form-control" id="contact_details" name="contact_details" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="photo_url" class="form-label">Upload Photo</label>
                        <input type="file" class="form-control" id="photo_url" name="photo_url" accept="image/*" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Save Details</button>
            </form>
        </div>
    </fieldset>

    <!-- Upload Section: File Upload -->
    <fieldset class="border rounded-3 mb-4 mx-5 px-4 pb-4">
        <legend class="custom-legend">Upload JSON or Excel File</legend>
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" id="upload-form">
                <div class="mb-3">
                    <input type="file" class="form-control" name="file" accept=".json, .xlsx, .xls" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </fieldset>
</div>


        <!-- Modal Structure -->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body-content">
                        <!-- Feedback message will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="location.reload()">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container for alerts -->
        <div id="alert-container" class="container mt-3"></div>

    </div>
    <!-- Bootstrap 5 JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="./media/js/index.js"></script>
    <script src="./media/js/saveForm.js"></script>
</body>

</html>