<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
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
                            <a class="nav-link" href="./upload.php">Upload Report</a>
                        </li>
                        <li class="nav-item how-to-use">
                            <a class="nav-link" href="./all-missing-records.php">Unidentified Cases</a>
                        </li>
                        <li class="nav-item how-to-use">
                            <a class="nav-link active" aria-current="page" href="./all-found-records.php">Identified Cases</a>
                        </li>
                        <li class="nav-item notification">
                            <i class="bi bi-bell" data-bs-toggle="popover" data-bs-placement="bottom"
                                title="Notifications" data-bs-content="
                              <div class='d-flex align-items-center mb-2'>
                                <div>
                                  <p class='mb-0'>New Match Found for FIR Number:FIR54321 </p>
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

        <div class="container mt-5">
            <p class="text-center fs-5 text-bold">All Identified Cases</p>
            <div class="row" id="missingPersonsContainer">
                <?php
                $testimonials = json_decode(file_get_contents("./media/data/reports.json"), true);
                foreach ($testimonials as $person) {
                    if ($person['isFound'] && !$person['isDeleted']) {

                        echo
                            '<div class="col-md-12 mb-4">
                            <div class="card h-100">
                                <div class="row g-0 user-details">
                                    <div class="col-md-4">
                                        <img src="./media/images/user/' . htmlspecialchars($person['photo_url']) . '" loading="lazy" class="img-fluid rounded-start"  alt="' . htmlspecialchars($person['name']) . '" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body ps-5">
                                            <h5 class="card-title">' . htmlspecialchars($person['name']) . '</h5>
                                            <p class="card-text">
                                                <strong>Age : </strong>' . htmlspecialchars($person['age']) . '<br>
                                                <strong>Address : </strong> ' . htmlspecialchars($person['address']) . '<br>
                                                <strong>Pin Code : </strong> ' . htmlspecialchars($person['pincode']) . '<br>
                                                <strong>Identifying Mark : </strong>' . htmlspecialchars($person['mark']) . '<br>
                                                <strong>FIR Number : </strong>' . htmlspecialchars($person['FIR_number']) . '<br>
                                                <strong>Contact Details : </strong>' . htmlspecialchars($person['metadata']['contact_details']) . '
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
                ?>
            </div>
        </div>


    </div>
    <!-- Bootstrap 5 JavaScript and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="./media/js/index.js"></script>
</body>

</html>