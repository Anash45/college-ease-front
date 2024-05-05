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
        <title>CollageEase</title>
        <link rel="stylesheet" href="./assets/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/dist/fontawesome/css/all.css">
        <link rel="stylesheet" href="./assets/dist/css/style.css">
    </head>

    <body cz-shortcut-listen="true">
        <?php include 'header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <?php include "navbar.php"; ?>
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4">
                    <div class="p-5">
                        <div class="card rounded-5 bg-peach">
                            <div class="card-body pt-0">
                                <div class="text-center mb-4">
                                    <img src="./assets/img/name.png" alt="Image" class="translate-5" height="80">
                                </div>
                                <table class="table bg-transparent" id="gpaTable">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Grade</th>
                                            <th>Credits</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="eg: Course Name"
                                                    class="form-control bg-peach course-name">
                                            </td>
                                            <td>
                                                <input class="form-control bg-peach course-grade" type="text"
                                                    placeholder="eg: 3.2" pattern="[0-9.]{1,}">
                                            </td>
                                            <td>
                                                <select class="form-control bg-peach course-credits">
                                                    <option value="">Select Credits</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-dark bg-teapink border-0 rounded-5"
                                                    onclick="removeRow(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="eg: Course Name"
                                                    class="form-control bg-peach course-name">
                                            </td>
                                            <td>
                                                <input class="form-control bg-peach course-grade" type="text"
                                                    placeholder="eg: 3.2" pattern="[0-9.]{1,}">
                                            </td>
                                            <td>
                                                <select class="form-control bg-peach course-credits">
                                                    <option value="">Select Credits</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-dark bg-teapink border-0 rounded-5"
                                                    onclick="removeRow(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="eg: Course Name"
                                                    class="form-control bg-peach course-name">
                                            </td>
                                            <td>
                                                <input class="form-control bg-peach course-grade" type="text"
                                                    placeholder="eg: 3.2" pattern="[0-9.]{1,}">
                                            </td>
                                            <td>
                                                <select class="form-control bg-peach course-credits">
                                                    <option value="">Select Credits</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-dark bg-teapink border-0 rounded-5"
                                                    onclick="removeRow(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="eg: Course Name"
                                                    class="form-control bg-peach course-name">
                                            </td>
                                            <td>
                                                <input class="form-control bg-peach course-grade" type="text"
                                                    placeholder="eg: 3.2" pattern="[0-9.]{1,}">
                                            </td>
                                            <td>
                                                <select class="form-control bg-peach course-credits">
                                                    <option value="">Select Credits</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button class="btn btn-dark bg-teapink border-0 rounded-5"
                                                    onclick="removeRow(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr id="gpaRow">
                                            <th colspan="2" class="text-end" id="gpaLabel">GPA</th>
                                            <td colspan="2" id="gpaValue"></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button onclick="addCourse()"
                                                    class="btn btn-danger border-0 rounded-4 d-flex align-items-center gap-2 justify-content-center mx-auto">
                                                    <span>Add Course</span>
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                            <td colspan="2">
                                                <button onclick="calculateGPA()"
                                                    class="btn btn-warning border-0 rounded-4 bg-teapink d-flex align-items-center gap-2 justify-content-center mx-auto">
                                                    <span>Calculate</span>
                                                    <i class="fa fa-chevron-right"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
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