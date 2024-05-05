<?php
require 'db_conn.php';
if (!isLoggedIn()) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CollageEase</title>
        <link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/dist/fontawesome/css/all.css">
        <link rel="stylesheet" href="./assets/dist/css/style.css">
    </head>

    <body cz-shortcut-listen="true">
        <header class="navbar navbar-light sticky-top bg-light flex-md-nowrap p-0">
            <a class="navbar-brand col-md-4 col-lg-3 me-0 px-3 d-flex justify-content-between order-md-1 order-2"
                href="dashboard.php">
                <img src="./assets/img/bricks.png" alt="Img" height="60"><img src="./assets/img/logo.png" alt="Img"
                    height="60"></a>
            <button class="navbar-toggler order-1 d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav order-3">
                <div class="nav-item text-nowrap">
                    <a class="btn btn-danger text-white rounded-5" href="logout.php"><i class="fal fa-sign-out"></i></a>
                </div>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <?php include "navbar.php"; ?>
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4">
                    <form method="GET" action="compare.php" class="row my-4">
                        <div class="mb-4">
                            <div
                                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                                <h2 class="h2 page-title">Private Universities</h2>
                            </div>
                            <div class="row">
                                <?php
                                // Fetch programs with state "private" and degree "bachelors"
                                $sql = "SELECT * FROM programs WHERE State='private' AND Degree = 'bachelors'";
                                $result = mysqli_query($conn, $sql);

                                // Check if there are any matching programs
                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through each program and display it in the specified format
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $universityName = $row['Name'];
                                        $typeOfUniversity = $row['State'];
                                        $location = $row['Location'];
                                        $rank = $row['Rank'];
                                        $scholarships = $row['Scholarships'];
                                        $careerServices = $row['Career_Services'];
                                        // Display the program in the specified format
                                        echo '<div class="col-sm-6 px-lg-5 px-md-4 px-3 py-3">';
                                        echo '<label class="card compare-card rounded-5">';
                                        echo '<input type="checkbox" name="programs[]" value="' . $row['ID'] . '" class="program_check">';
                                        echo '<div class="card-body p-3">';
                                        echo '<div class="d-flex flex-column align-items-center justify-content-center gap-3">';
                                        echo '<img src="./assets/img/university-logo.png" alt="Uni logo" height="50">';
                                        echo '<h4 class="h4 libre-baskerville fw-bold mb-0 cap">' . $universityName . '</h4>';
                                        echo '<div class="d-flex align-items-center justify-content-center gap-3">';
                                        echo '<a href="' . $row['Registration_Link'] . '" target="_blank" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Register Now</span> <i class="fal fa-sign-in fs-12"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                } else {
                                    // No matching programs found
                                    echo '<h3 class="h3 text-center montserrat fw-bold">"There are no universities for this category"</h3>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div
                                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                                <h2 class="h2 page-title">Public Universities</h2>
                            </div>
                            <div class="row">
                                <?php
                                // Fetch programs with state "public" and degree "bachelors"
                                $sql = "SELECT * FROM programs WHERE State='public' AND Degree = 'bachelors'";
                                $result = mysqli_query($conn, $sql);

                                // Check if there are any matching programs
                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through each program and display it in the specified format
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $universityName = $row['Name'];
                                        $typeOfUniversity = $row['State'];
                                        $location = $row['Location'];
                                        $rank = $row['Rank'];
                                        $scholarships = $row['Scholarships'];
                                        $careerServices = $row['Career_Services'];
                                        // Display the program in the specified format
                                        echo '<div class="col-sm-6 px-lg-5 px-md-4 px-3 py-3">';
                                        echo '<label class="card compare-card rounded-5">';
                                        echo '<input type="checkbox" name="programs[]" value="' . $row['ID'] . '" class="program_check">';
                                        echo '<div class="card-body p-3">';
                                        echo '<div class="d-flex flex-column align-items-center justify-content-center gap-3">';
                                        echo '<img src="./assets/img/university-logo.png" alt="Uni logo" height="50">';
                                        echo '<h4 class="h4 libre-baskerville fw-bold mb-0 cap">' . $universityName . '</h4>';
                                        echo '<div class="d-flex align-items-center justify-content-center gap-3">';                                        echo '<button type="button" onclick="programDetails(`' . htmlspecialchars($universityName) . '`,`' . htmlspecialchars($typeOfUniversity) . '`,`' . htmlspecialchars($location) . '`,`' . htmlspecialchars($rank) . '`,`' . htmlspecialchars($scholarships) . '`,`' . htmlspecialchars($careerServices) . '`)" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Know More</span> <i class="fa fa-plus fs-8"></i></button>';
                                        echo '<a href="' . $row['Registration_Link'] . '" target="_blank" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Register Now</span> <i class="fal fa-sign-in fs-12"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                } else {
                                    // No matching programs found
                                    echo '<h3 class="h3 text-center montserrat fw-bold">"There are no universities for this category"</h3>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div
                                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                                <h2 class="h2 page-title">Diploma</h2>
                            </div>
                            <div class="row">
                                <?php
                                // Fetch programs with state "public" and degree "bachelors"
                                $sql = "SELECT * FROM programs WHERE Degree = 'diploma'";
                                $result = mysqli_query($conn, $sql);

                                // Check if there are any matching programs
                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through each program and display it in the specified format
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $universityName = $row['Name'];
                                        $typeOfUniversity = $row['State'];
                                        $location = $row['Location'];
                                        $rank = $row['Rank'];
                                        $scholarships = $row['Scholarships'];
                                        $careerServices = $row['Career_Services'];
                                        // Display the program in the specified format
                                        echo '<div class="col-sm-6 px-lg-5 px-md-4 px-3 py-3">';
                                        echo '<label class="card compare-card rounded-5">';
                                        echo '<input type="checkbox" name="programs[]" value="' . $row['ID'] . '" class="program_check">';
                                        echo '<div class="card-body p-3">';
                                        echo '<div class="d-flex flex-column align-items-center justify-content-center gap-3">';
                                        echo '<img src="./assets/img/university-logo.png" alt="Uni logo" height="50">';
                                        echo '<h4 class="h4 libre-baskerville fw-bold mb-0 cap">' . $universityName . '</h4>';
                                        echo '<div class="d-flex align-items-center justify-content-center gap-3">';
                                        echo '<button type="button" onclick="programDetails(`' . htmlspecialchars($universityName) . '`,`' . htmlspecialchars($typeOfUniversity) . '`,`' . htmlspecialchars($location) . '`,`' . htmlspecialchars($rank) . '`,`' . htmlspecialchars($scholarships) . '`,`' . htmlspecialchars($careerServices) . '`)" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Know More</span> <i class="fa fa-plus fs-8"></i></button>';
                                        echo '<a href="' . $row['Registration_Link'] . '" target="_blank" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Register Now</span> <i class="fal fa-sign-in fs-12"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</label>';
                                        echo '</div>';
                                    }
                                } else {
                                    // No matching programs found
                                    echo '<h3 class="h3 text-center montserrat fw-bold">"There are no universities for this category"</h3>';
                                }
                                ?>
                            </div>
                        </div><button type="submit" class="compare_float btn d-flex align-items-center gap-2"
                            title="Select 2 programs and compare..." disabled><i
                                class="fal fa-arrows-h"></i><span>Compare</span></button>
                    </form>
                </main>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="programDetailsModal" tabindex="-1" aria-labelledby="programDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content bg-peach">
                    <div class="modal-header">
                        <h5 class="modal-title" id="programDetailsModalLabel">Program Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="col-md-6">
                            <tr class="mb-3">
                                <th>University Name:</th>
                                <td id="universityName"></td>
                            </tr>
                            <tr class="mb-3">
                                <th>Type:</th>
                                <td id="typeOfUniversity"></td>
                            </tr>
                            <tr class="mb-3">
                                <th>Location:</th>
                                <td id="location"></td>
                            </tr>
                            <tr class="mb-3">
                                <th>Rank:</th>
                                <td id="rank"></td>
                            </tr>
                            <tr class="mb-3">
                                <th>Scholarships:</th>
                                <td id="scholarships"></td>
                            </tr>
                            <tr class="mb-3">
                                <th>Career Services:</th>
                                <td id="careerServices"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>