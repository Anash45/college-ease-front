<?php
// Include the database connection file
require_once "db_conn.php";
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
                    <div class="d-flex py-5 my-5 flex-column align-items-center justify-content-center">
                        <h2 class="libre-baskerville text-center fw-bold fs-30">Contact Us</h2>
                        <ul class="p-0 d-flex flex-column gap-2 justify-content-center list-unstyled">
                            <li>
                                <a href="#" class="fw-medium text-decoration-none"><i class="fa fa-phone me-2"></i>+123-456-7890</a>
                            </li>
                            <li>
                                <a href="#" class="fw-medium text-decoration-none"><i class="fa fa-globe me-2"></i>www.CollageEase.com</a>
                            </li>
                            <li>
                                <a href="#" class="fw-medium text-decoration-none"><i class="fab fa-linkedin me-2"></i>My Linked In</a>
                            </li>
                        </ul>
                        <div>
                            <img src="./assets/img/name.png" alt="Image" width="200" class="img-fluid">
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