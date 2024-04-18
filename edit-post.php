<?php
// Include the database connection file
require_once "db_conn.php";
if(!isLoggedIn()){
    header('location:login.php');
}

$info = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && (isAdmin() || isLoggedIn())) {
    // Define variables and initialize with empty values
    $id = $title = $content = "";

    // Process form data when the form is submitted
    $id = $_GET['ID']; // Get the ID from the URL
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);

    // Check if the user is the owner of the post
    if (!isAdmin()) {
        // Query to check if the user is the owner of the post
        $checkQuery = "SELECT * FROM posts WHERE postID = $id AND userID = $userID"; // Replace 'USER_ID' with the actual user ID
        $result = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($result) == 0) {
            // If the user is not the owner of the post, redirect or show an error message
            $info = '<div class="alert alert-danger">You are not authorized to update this post!</div>';
        }
    }

    // Update the record if the user is authorized
    if (empty($info)) {
        $sql = "UPDATE posts SET title='$title', content='$content' WHERE postID=$id";
        if (mysqli_query($conn, $sql)) {
            // Redirect to success page or display success message
            $info = '<div class="alert alert-success">Post updated successfully!</div>';
        } else {
            // Display error message
            $info = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
        }
    }
}


// Initialize variables to store form field values
$name = $state = $degree = $registration_date = $registration_link = $location = $rank = $career_services = $scholarships = "";

// Check if the ID parameter is set in the URL
if (isset($_GET['ID'])) {
    // Retrieve the ID from the URL
    $id = mysqli_real_escape_string($conn, $_GET['ID']);

    // Query to fetch record based on the ID
    $sql = "SELECT * FROM posts WHERE postID = $id";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if record exists
    if (mysqli_num_rows($result) > 0) {
        // Fetch the record
        $row = mysqli_fetch_assoc($result);

        // Assign values to form fields
        $title = $row['title'];
        $content = $row['content'];
    }
} else {
    header('location:ad_community.php');
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
                                <!-- Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control bg-transparent border-dark" id="title"
                                        required name="title" value="<?php echo htmlspecialchars($title); ?>">
                                </div>
                                <!-- Content -->
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea class="form-control bg-transparent border-dark" id="content" required
                                        name="content" rows="4"><?php echo ltrim($content); ?></textarea>
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