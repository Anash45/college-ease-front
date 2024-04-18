<?php
// Include the database connection file
require_once "db_conn.php";
if(!isAdmin()){
    header('location:login.php');
}

$info = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $id = $name = $state = $degree = $registration_date = $registration_link = $location = $rank = $scholarships = $career_services = "";

    // Process form data when the form is submitted
    $id = $_GET['ID']; // Get the ID from the URL
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $state = mysqli_real_escape_string($conn, $_POST["state"]);
    $degree = mysqli_real_escape_string($conn, $_POST["degree"]);
    $registration_date = mysqli_real_escape_string($conn, $_POST["registration_date"]);
    $registration_link = mysqli_real_escape_string($conn, $_POST["registration_link"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);
    $rank = mysqli_real_escape_string($conn, $_POST["rank"]);
    $scholarships = mysqli_real_escape_string($conn, $_POST["scholarships"]);
    $career_services = mysqli_real_escape_string($conn, $_POST["career_services"]);

    // Update the record
    $sql = "UPDATE programs SET Name='$name', State='$state', Degree='$degree', Registration_Date='$registration_date', Registration_Link='$registration_link', Location='$location', `Rank`=$rank, Scholarships='$scholarships', Career_Services='$career_services' WHERE ID=$id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to success page or display success message
        $info = '<div class="alert alert-success">Program updated successfully!</div>';
    } else {
        // Display error message
        $info = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}


// Initialize variables to store form field values
$name = $state = $degree = $registration_date = $registration_link = $location = $rank = $career_services = $scholarships = "";

// Check if the ID parameter is set in the URL
if (isset($_GET['ID'])) {
    // Retrieve the ID from the URL
    $id = mysqli_real_escape_string($conn, $_GET['ID']);

    // Query to fetch record based on the ID
    $sql = "SELECT * FROM programs WHERE ID = $id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if record exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the record
        $row = mysqli_fetch_assoc($result);

        // Assign values to form fields
        $name = $row['Name'];
        $state = $row['State'];
        $degree = $row['Degree'];
        $registration_date = $row['Registration_Date'];
        $registration_link = $row['Registration_Link'];
        $location = $row['Location'];
        $rank = $row['Rank'];
        $career_services = $row['Career_Services'];
        $scholarships = $row['Scholarships'];
    }
} else {
    header('location:dashboard.php');
}

// Close connection
mysqli_close($conn);
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
                <?php include 'navbar.php'; ?>
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4 py-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                        <h2 class="h2 page-title">Programs</h2>
                    </div>
                    <?php echo $info; ?>
                    <div class="card bg-peach">
                        <div class="card-body">
                            <a href="dashboard.php" class="btn ps-0 fs-18"><i class="fa fa-arrow-left"></i></a>
                            <!-- Form -->
                            <form method="POST" action="">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control bg-transparent border-dark" id="name"
                                        required name="name" value="<?php echo htmlspecialchars($name); ?>">
                                </div>
                                <!-- State -->
                                <div class="mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select bg-transparent border-dark" id="state" required
                                        name="state">
                                        <option value="public" <?php if ($state == 'public')
                                            echo 'selected'; ?>>Public
                                            University</option>
                                        <option value="private" <?php if ($state == 'private')
                                            echo 'selected'; ?>>Private
                                            University</option>
                                    </select>
                                </div>
                                <!-- Degree -->
                                <div class="mb-3">
                                    <label for="degree" class="form-label">Degree</label>
                                    <select class="form-select bg-transparent border-dark" id="degree" required
                                        name="degree">
                                        <option value="bachelors" <?php if ($degree == 'bachelors')
                                            echo 'selected'; ?>>
                                            Bachelors</option>
                                        <option value="diploma" <?php if ($degree == 'diploma')
                                            echo 'selected'; ?>>
                                            Diploma</option>
                                        <option value="masters" <?php if ($degree == 'masters')
                                            echo 'selected'; ?>>
                                            Masters</option>
                                        <option value="phd" <?php if ($degree == 'phd')
                                            echo 'selected'; ?>>PHD</option>
                                    </select>
                                </div>
                                <!-- Registration Date -->
                                <div class="mb-3">
                                    <label for="registration_date" class="form-label">Registration Date</label>
                                    <input type="date" class="form-control bg-transparent border-dark"
                                        id="registration_date" required name="registration_date"
                                        value="<?php echo htmlspecialchars($registration_date); ?>">
                                </div>
                                <!-- Registration Link -->
                                <div class="mb-3">
                                    <label for="registration_link" class="form-label">Registration Link</label>
                                    <input type="url" class="form-control bg-transparent border-dark"
                                        id="registration_link" required name="registration_link"
                                        value="<?php echo htmlspecialchars($registration_link); ?>">
                                </div>
                                <!-- Location -->
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control bg-transparent border-dark" id="location"
                                        required name="location" value="<?php echo htmlspecialchars($location); ?>">
                                </div>
                                <!-- Rank -->
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Rank</label>
                                    <input type="number" class="form-control bg-transparent border-dark" id="rank"
                                        required name="rank" value="<?php echo htmlspecialchars($rank); ?>">
                                </div>
                                <!-- Scholarships -->
                                <div class="mb-3">
                                    <label for="scholarships" class="form-label">Scholarships</label>
                                    <select class="form-select bg-transparent border-dark" id="scholarships" required
                                        name="scholarships">
                                        <option value="Included" <?php if ($scholarships == 'Included')
                                            echo 'selected'; ?>>Included</option>
                                        <option value="Not Included" <?php if ($scholarships == 'Not Included')
                                            echo 'selected'; ?>>Not Included</option>
                                    </select>
                                </div>
                                <!-- Career Services -->
                                <div class="mb-3">
                                    <label for="career_services" class="form-label">Career Services</label>
                                    <select class="form-select bg-transparent border-dark" id="career_services" required
                                        name="career_services">
                                        <option value="Included" <?php if ($career_services == 'Included')
                                            echo 'selected'; ?>>Included</option>
                                        <option value="Not Included" <?php if ($career_services == 'Not Included')
                                            echo 'selected'; ?>>Not Included</option>
                                    </select>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn bg-teapink fw-medium rounded-5">Submit</button>
                            </form>
                            <!-- End of Form -->
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