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
                        <h2 class="h2 page-title">Comparison</h2>
                    </div>
                    <div class="row">
                        <div class="col-4 px-sm-2 px-1">
                            <div class="card rounded-5 bg-transparent border-0">
                                <div class="card-body p-sm-3 p-1">
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label opacity-0"> Name </p>
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label"> Type of universiy </p>
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label"> Degree </p>
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label"> Location </p>
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label"> Rank </p>
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label"> Scholarships </p>
                                    <p class="mb-3 p-2 rounded-5 text-center comp-label"> Career Services </p>
                                </div>
                            </div>
                        </div>
                        <?php
                        if (isset($_GET['program1']) && isset($_GET['program2'])) {
                            // Get the program IDs from the URL params
                            $program1_id = isset($_GET['program1']) ? $_GET['program1'] : null;
                            $program2_id = isset($_GET['program2']) ? $_GET['program2'] : null;

                            // Fetch program data from the database for program 1
                            $sql_program1 = "SELECT * FROM programs WHERE ID = $program1_id";
                            $result_program1 = mysqli_query($conn, $sql_program1);
                            $row_program1 = mysqli_fetch_assoc($result_program1);

                            // Fetch program data from the database for program 2
                            $sql_program2 = "SELECT * FROM programs WHERE ID = $program2_id";
                            $result_program2 = mysqli_query($conn, $sql_program2);
                            $row_program2 = mysqli_fetch_assoc($result_program2);
                            ?>
                            <div class="col-4 px-sm-2 px-1">
                                <div class="card rounded-5 bg-peach cap">
                                    <div class="card-body p-sm-3 p-1">
                                        <p class="mb-3 p-2 rounded-5 comp-name text-center comp-value">
                                            <?php echo $row_program1['Name'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo ucfirst($row_program1['State']) ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo ucfirst($row_program1['Degree']) ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program1['Location'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program1['Rank'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program1['Scholarships'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program1['Career_Services'] ?? 'null'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 px-sm-2 px-1">
                                <div class="card rounded-5 bg-peach cap">
                                    <div class="card-body p-sm-3 p-1">
                                        <p class="mb-3 p-2 rounded-5 comp-name text-center comp-value">
                                            <?php echo $row_program2['Name'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo ucfirst($row_program2['State']) ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo ucfirst($row_program2['Degree']) ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program2['Location'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program2['Rank'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program2['Scholarships'] ?? 'null'; ?>
                                        </p>
                                        <p class="mb-3 p-2 rounded-5 text-center comp-value">
                                            <?php echo $row_program2['Career_Services'] ?? 'null'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>