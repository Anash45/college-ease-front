<?php
// Include the database connection file
require_once "db_conn.php";


$name = $email = $password = $role = "";
$info = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values

    // Process form data when the form is submitted
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);

    // Check if the email already exists in the database
    $sql_check_email = "SELECT * FROM users WHERE Email='$email'";
    $result_check_email = mysqli_query($conn, $sql_check_email);

    if (mysqli_num_rows($result_check_email) > 0) {
        // Email already exists
        $info = '<div class="alert alert-danger">Email already exists!</div>';
    } else {
        // Email does not exist, insert user into the database
        $sql_insert_user = "INSERT INTO users (Name, Email, Password, Role) VALUES ('$name', '$email', '$password', '$role')";

        if (mysqli_query($conn, $sql_insert_user)) {
            // User inserted successfully
            $info = '<div class="alert alert-success">User created successfully!</div>';
        } else {
            // Error inserting user
            $info = '<div class="alert alert-danger">Error creating user: ' . mysqli_error($conn) . '</div>';
        }
        $name = $email = $password = $role = "";
    }

    // Close connection
    mysqli_close($conn);
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

    <body class="bg-peach d-flex flex-column justify-content-center align-items-center py-5">
        <div class="container d-flex flex-column align-items-center justify-content-center">
            <div class="row align-items-center w-100">
                <div class="col-md-6">
                    <img src="./assets/img/logo.png" alt="Logo" width="80" class="img-fluid d-block mb-3">
                    <div class="text-uppercase libre-baskerville">
                        <h1 class="fw-bold form-title fw-normal">WELCOME!</h1>
                        <p class="form-subtitle">Stay on top of it</p>
                    </div>
                    <img src="./assets/img/name.png" alt="Image" class="img-fluid login-img">
                </div>
                <div class="col-md-5 mx-auto">
                    <div class="card rounded-5 pt-3">
                        <div class="card-body pt-5">
                            <form action="" method="post" class="container">
                                <h2 class="fw-bold text-center montserrat font-title">Create New Account</h2>
                                <?php echo $info; ?>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control form-control-lg rounded-5 bg-light" id="name"
                                        name="name" value="<?php echo $name; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-lg rounded-5 bg-light"
                                        id="email" name="email" value="<?php echo $email; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-lg rounded-5 bg-light"
                                        id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select form-select-lg rounded-5 bg-light" id="role" name="role"
                                        required>
                                        <option value="" selected disabled>Select Role</option>
                                        <option value="alumni">Alumni</option>
                                        <option value="student">Student</option>
                                    </select>
                                </div>
                                <div class="text-center mb-2">
                                    <button type="submit" class="btn btn-red btn-lg rounded-5 w-100">Sign Up</button>
                                </div>
                                <p class="text-red text-center"><small>Already Registered? <a href="login.php"
                                            class="fw-bold text-red">Login</a></small></p>
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