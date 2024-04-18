<?php
require 'db_conn.php';
if(!isLoggedIn()){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>College Ease</title>
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
                        <div class="col-md-5 py-md-0 py-2">
                            <select name="program1" required class="form-control border-dark bg-transparent">
                                <option value="">Select Program</option>
                                <?php
                                // Fetch all programs from the database
                                $sql_program1 = "SELECT * FROM programs";
                                $result_program1 = mysqli_query($conn, $sql_program1);

                                // Check if there are any programs
                                if (mysqli_num_rows($result_program1) > 0) {
                                    // Loop through each program and generate an option for each
                                    while ($row_program1 = mysqli_fetch_assoc($result_program1)) {
                                        echo '<option value="' . $row_program1['ID'] . '">' . $row_program1['Name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No programs found</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5 py-md-0 py-2">
                            <select name="program2" required class="form-control border-dark bg-transparent">
                                <option value="">Select Program</option>
                                <?php
                                // Fetch all programs from the database
                                $sql_program2 = "SELECT * FROM programs";
                                $result_program2 = mysqli_query($conn, $sql_program2);

                                // Check if there are any programs
                                if (mysqli_num_rows($result_program2) > 0) {
                                    // Loop through each program and generate an option for each
                                    while ($row_program2 = mysqli_fetch_assoc($result_program2)) {
                                        echo '<option value="' . $row_program2['ID'] . '">' . $row_program2['Name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No programs found</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-2 py-md-0 py-2">
                            <button type="submit" class="btn bg-peach rounded-5 fw-medium">Compare</button>
                        </div>
                    </form>
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
                                    // Display the program in the specified format
                                    echo '<div class="col-sm-6 px-lg-5 px-md-4 px-3 py-3">';
                                    echo '<div class="card rounded-5">';
                                    echo '<div class="card-body p-3">';
                                    echo '<div class="d-flex flex-column align-items-center justify-content-center gap-3">';
                                    echo '<img src="./assets/img/university-logo.png" alt="Uni logo" height="50">';
                                    echo '<h4 class="h4 libre-baskerville fw-bold mb-0 cap">' . $universityName . '</h4>';
                                    echo '<div class="d-flex align-items-center justify-content-center gap-3">';
                                    echo '<a href="program-details.php?programID=' . $row['ID'] . '" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Know More</span> <i class="fa fa-plus fs-8"></i></a>';
                                    echo '<a href="' . $row['Registration_Link'] . '" target="_blank" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Register Now</span> <i class="fal fa-sign-in fs-12"></i></a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
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
                                    // Display the program in the specified format
                                    echo '<div class="col-sm-6 px-lg-5 px-md-4 px-3 py-3">';
                                    echo '<div class="card rounded-5">';
                                    echo '<div class="card-body p-3">';
                                    echo '<div class="d-flex flex-column align-items-center justify-content-center gap-3">';
                                    echo '<img src="./assets/img/university-logo.png" alt="Uni logo" height="50">';
                                    echo '<h4 class="h4 libre-baskerville fw-bold mb-0 cap">' . $universityName . '</h4>';
                                    echo '<div class="d-flex align-items-center justify-content-center gap-3">';
                                    echo '<a href="program-details.php?programID=' . $row['ID'] . '" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Know More</span> <i class="fa fa-plus fs-8"></i></a>';
                                    echo '<a href="' . $row['Registration_Link'] . '" target="_blank" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Register Now</span> <i class="fal fa-sign-in fs-12"></i></a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
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
                                    // Display the program in the specified format
                                    echo '<div class="col-sm-6 px-lg-5 px-md-4 px-3 py-3">';
                                    echo '<div class="card rounded-5">';
                                    echo '<div class="card-body p-3">';
                                    echo '<div class="d-flex flex-column align-items-center justify-content-center gap-3">';
                                    echo '<img src="./assets/img/university-logo.png" alt="Uni logo" height="50">';
                                    echo '<h4 class="h4 libre-baskerville fw-bold mb-0 cap">' . $universityName . '</h4>';
                                    echo '<div class="d-flex align-items-center justify-content-center gap-3">';
                                    echo '<a href="program-details.php?programID=' . $row['ID'] . '" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Know More</span> <i class="fa fa-plus fs-8"></i></a>';
                                    echo '<a href="' . $row['Registration_Link'] . '" target="_blank" class="btn btn-light btn-sm bg-peach d-flex align-items-center gap-2 fw-medium"><span>Register Now</span> <i class="fal fa-sign-in fs-12"></i></a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                // No matching programs found
                                echo '<h3 class="h3 text-center montserrat fw-bold">"There are no universities for this category"</h3>';
                            }
                            ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>