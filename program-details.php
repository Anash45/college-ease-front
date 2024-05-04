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
        <?php include 'header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <?php include "navbar.php"; ?>
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4 py-4">
                    <div
                        class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h2 class="h2 page-title">Program Details</h2>
                    </div>
                    <div class="row">
                        <div class="col-8 px-sm-2 px-1 mx-auto">
                            <?php
                            // Check if programID is set in the URL parameter
                            if (isset($_GET['programID'])) {
                                $programID = $_GET['programID']; // Get the programID from the URL
                            
                                // Fetch program data based on programID
                                $sql = "SELECT * FROM programs WHERE ID=$programID";
                                $result = mysqli_query($conn, $sql);

                                // Check if program data is found
                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $universityName = $row['Name'];
                                    $typeOfUniversity = $row['State'];
                                    $location = $row['Location'];
                                    $rank = $row['Rank'];
                                    $scholarships = $row['Scholarships'];
                                    $careerServices = $row['Career_Services'];

                                    // Display program data in the specified format
                                    echo '<div class="card rounded-5 bg-peach cap">';
                                    echo '<div class="card-body p-sm-3 p-1">';
                                    echo '<p class="mb-3 p-2 rounded-5 text-center comp-value">' . $universityName . '</p>';
                                    echo '<p class="mb-3 p-2 rounded-5 text-center comp-value">' . $typeOfUniversity . '</p>';
                                    echo '<p class="mb-3 p-2 rounded-5 text-center comp-value">' . $location . '</p>';
                                    echo '<p class="mb-3 p-2 rounded-5 text-center comp-value">' . $rank . '</p>';
                                    echo '<p class="mb-3 p-2 rounded-5 text-center comp-value">' . $scholarships . '</p>';
                                    echo '<p class="mb-3 p-2 rounded-5 text-center comp-value">' . $careerServices . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    // Program data not found
                                    echo '<p>No program found with the specified ID.</p>';
                                }
                            } else {
                                // programID parameter not set
                                echo '<p>programID parameter not set.</p>';
                            }

                            // Close connection
                            mysqli_close($conn);
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