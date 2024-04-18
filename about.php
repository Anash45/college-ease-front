<?php
// Include the database connection file
require_once "db_conn.php";
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
                    <div class="m-lg-5 m-4 me-0 me-lg-0 bg-peach py-3">
                        <div class="text-end p-3 border-bottom border-2 mb-4">
                            <img src="./assets/img/name.png" alt="img" height="50">
                        </div>
                        <div
                            class="d-flex bg-brown justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h2 class="h2 page-title ps-3">About Us</h2>
                        </div>
                        <div class="d-flex py-3 px-4 gap-5 flex-md-row flex-column">
                            <img src="./assets/img/about-img.jpg" alt="About" class="about-img">
                            <div class="fs-16 fw-medium">
                                <p>Welcome to CollageEase, your gateway to informed higher education decisions in
                                    Malaysia! At CollageEase, we understand that choosing the right university program
                                    is a pivotal moment in one's academic journey.</p>
                                <p class="ps-5">Our mission is to empower students with
                                    comprehensive and up-to-date information,
                                    ensuring that every decision is well-
                                    informed and aligned with their aspirations.</p>
                            </div>
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