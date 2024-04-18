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
                    <div class="row">
                        <div class="col-lg-5 py-3">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                                <h1 class="faq-title mb-3">FAQ</h1>
                                <p class="fw-semibold fs-20 mb-5">Frequently Asked Questions</p>
                                <p class="fw-medium fs-18">In case you had concerns , here are some frequently asked
                                    questions and answers to clear things up.</p>
                            </div>
                        </div>
                        <div class="col-lg-7 py-3 d-flex flex-column justify-content-center align-items-center">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne"> WHY DO UNIVERSITIES FREQUENTLY DELAY ANNOUNCING
                                            THEIR DATES? </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="m-0"> The lack of a university means that she often has not
                                                announced her dates yet. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo"> WHO IS ELIGIBLE FOR
                                            GRADUATE STUDIES AND BRIDGING PROGRAMS? </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="m-0">Graduate studies and bridging are not for high school
                                                graduates. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree"> HOW CAN THE
                                            REGISTRATION DATES BE OBTAINED? </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p class="m-0">You can tell us the registration dates by clicking here for
                                                appointments.</p>
                                        </div>
                                    </div>
                                </div>
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