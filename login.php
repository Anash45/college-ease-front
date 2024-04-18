<?php

// Include the database connection file
require_once "db_conn.php";
$info = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $email = $password = "";
    $info = "";

    // Process form data when the form is submitted
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the form fields
    if (empty($email) || empty($password)) {
        $info = '<div class="alert alert-danger">Please enter both email and password.</div>';
    } else {
        // Sanitize user input
        $email = mysqli_real_escape_string($conn, $email);

        // Query to retrieve hashed password
        $sql = "SELECT ID, Name, Role, Password FROM users WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // User exists, verify password
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['Password'];

            // Verify hashed password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, set session variables
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['Name'] = $row['Name'];
                $_SESSION['Role'] = $row['Role'];

                // Redirect user based on role
                if ($_SESSION['Role'] == 'admin') {
                    $_SESSION['home_url'] = 'dashboard.php';
                } elseif ($_SESSION['Role'] == 'student') {
                    $_SESSION['home_url'] = 'highschool_grads.php';
                }

                // Redirect to home page
                header("Location: " . $_SESSION['home_url']);
                exit();
            } else {
                // Incorrect password
                $info = '<div class="alert alert-danger">Incorrect password.</div>';
            }
        } else {
            // User does not exist
            $info = '<div class="alert alert-danger">User does not exist.</div>';
        }
    }
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

    <body class="bg-peach d-flex flex-column justify-content-center align-items-center py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="./assets/img/logo.png" alt="Logo" width="80" class="img-fluid d-block mb-3">
                    <div class="text-uppercase libre-baskerville">
                        <h1 class="fw-bold form-title fw-normal">WELCOME!</h1>
                        <p class="form-subtitle">Stay on top of it</p>
                    </div>
                    <img src="./assets/img/bricks.png" alt="Bricks" height="400" class="img-fluid">
                </div>
                <div class="col-md-5 mx-auto">
                    <div class="card rounded-5 pt-3">
                        <div class="card-body pt-5">
                            <form action="" method="post" class="container">
                                <h2 class="fw-bold text-center montserrat font-title">Log in</h2>
                                <?php echo $info; ?>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-lg rounded-5 bg-light"
                                        id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-5 bg-light"
                                        id="password" name="password" required>
                                </div>
                                <div class="text-center mb-2">
                                    <button type="submit" class="btn btn-red btn-lg rounded-5 w-100">Sign In</button>
                                </div>
                                <p class="text-red text-center"><small>Don't have an account? <a href="register.php"
                                            class="fw-bold text-red">Register</a></small></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/popper.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>