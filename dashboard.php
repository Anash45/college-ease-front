<?php
// Include the database connection file
require_once "db_conn.php";
if(!isAdmin()){
    header('location:login.php');
}

// Initialize response variable
$info = "";
if(isset($_GET['delete'])) {
    // Get the program ID from the URL parameter
    $program_id = $_GET['delete'];

    // Delete the program from the database
    $sql = "DELETE FROM programs WHERE ID = $program_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to success page or display success message
        $info = '<div class="alert alert-success">Program deleted successfully!</div>';
    } else {
        // Display error message
        $info = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $name = $state = $degree = $registration_date = $registration_link = $location = $rank = $scholarships = $career_services = "";

    // Process form data when the form is submitted
    $name = $_POST["name"];
    $state = $_POST["state"];
    $degree = $_POST["degree"];
    $registration_date = $_POST["registration_date"];
    $registration_link = $_POST["registration_link"];
    $location = $_POST["location"];
    $rank = $_POST["rank"];
    $scholarships = $_POST["scholarships"];
    $career_services = $_POST["career_services"];

    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $name);
    $state = mysqli_real_escape_string($conn, $state);
    $degree = mysqli_real_escape_string($conn, $degree);
    $registration_date = mysqli_real_escape_string($conn, $registration_date);
    $registration_link = mysqli_real_escape_string($conn, $registration_link);
    $location = mysqli_real_escape_string($conn, $location);
    $rank = mysqli_real_escape_string($conn, $rank);
    $scholarships = mysqli_real_escape_string($conn, $scholarships);
    $career_services = mysqli_real_escape_string($conn, $career_services);

    // Attempt insert query execution
    $sql = "INSERT INTO programs (Name, State, Degree, Registration_Date, Registration_Link, Location, `Rank`, Scholarships, Career_Services) 
            VALUES ('$name', '$state', '$degree', '$registration_date', '$registration_link', '$location', '$rank', '$scholarships', '$career_services')";

    if (mysqli_query($conn, $sql)) {
        // Set success message
        $info = '<div class="alert alert-success">Program added successfully!</div>';
    } else {
        // Set error message
        $info = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
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
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                        <h2 class="h2 page-title">Programs</h2>
                        <button class="btn fw-bold fs-14 rounded-5 px-3 bg-peach py-2 border-0" data-bs-toggle="modal"
                            data-bs-target="#addModal">Add Program</button>
                    </div>
                    <?php echo $info; ?>
                    <div class="table-responsive">
                        <table class="table text-center table-programs">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th>Degree</th>
                                    <th>Registration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query to select all records from the programs table
                                $sql = "SELECT * FROM programs";

                                // Execute the query
                                $result = mysqli_query($conn, $sql);

                                // Check if records exist
                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through each row in the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $formatted_id = str_pad($row['ID'], 4, '0', STR_PAD_LEFT);
                                        // Output each row in the specified format
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<a href="edit-program.php?ID=' . $row['ID'] . '" class="btn btn-sm rounded-5 btn-primary"><i class="fa fa-edit"></i></a>';
                                        echo '<a href="?delete=1" onclick="return confirm(\'Do you really want to delete this?\')" class="btn btn-sm rounded-5 btn-danger ms-1"><i class="fa fa-trash"></i></a>';
                                        echo '</td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">CEP-' . $formatted_id . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['Name'] . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . ucfirst($row['State']) . ' University</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . ucfirst($row['Degree']) . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . date('d-M-Y', strtotime($row['Registration_Date'])) . '</span></td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    // Output message if no records found
                                    echo '<tr><td colspan="6">No records found</td></tr>';
                                }

                                // Close connection
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-peach">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method="POST" action="">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control bg-transparent border-dark" id="name" required
                                name="name">
                        </div>
                        <!-- State -->
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select bg-transparent border-dark" id="state" required name="state">
                                <option value="public">Public University</option>
                                <option value="private">Private University</option>
                            </select>
                        </div>
                        <!-- Degree -->
                        <div class="mb-3">
                            <label for="degree" class="form-label">Degree</label>
                            <select class="form-select bg-transparent border-dark" id="degree" required name="degree">
                                <option value="bachelors">Bachelors</option>
                                <option value="diploma">Diploma</option>
                                <option value="masters">Masters</option>
                                <option value="phd">PHD</option>
                            </select>
                        </div>
                        <!-- Registration Date -->
                        <div class="mb-3">
                            <label for="registration_date" class="form-label">Registration Date</label>
                            <input type="date" class="form-control bg-transparent border-dark" id="registration_date"
                                required name="registration_date">
                        </div>
                        <!-- Registration Link -->
                        <div class="mb-3">
                            <label for="registration_link" class="form-label">Registration Link</label>
                            <input type="url" class="form-control bg-transparent border-dark" id="registration_link"
                                required name="registration_link">
                        </div>
                        <!-- New Fields -->
                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control bg-transparent border-dark" id="location" required
                                name="location">
                        </div>
                        <!-- Rank -->
                        <div class="mb-3">
                            <label for="rank" class="form-label">Rank</label>
                            <input type="number" class="form-control bg-transparent border-dark" id="rank" required
                                name="rank">
                        </div>
                        <!-- Scholarships -->
                        <div class="mb-3">
                            <label for="scholarships" class="form-label">Scholarships</label>
                            <select class="form-select bg-transparent border-dark" id="scholarships" required
                                name="scholarships">
                                <option value="Included">Included</option>
                                <option value="Not Included">Not Included</option>
                            </select>
                        </div>
                        <!-- Career Services -->
                        <div class="mb-3">
                            <label for="career_services" class="form-label">Career Services</label>
                            <select class="form-select bg-transparent border-dark" id="career_services" required
                                name="career_services">
                                <option value="Included">Included</option>
                                <option value="Not Included">Not Included</option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn bg-teapink fw-medium rounded-5">Submit</button>
                    </form>
                    <!-- End of Form -->
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>