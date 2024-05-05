<?php
// Include the database connection file
require_once "db_conn.php";
if (!isLoggedIn()) {
    header('location:login.php');
}
$info = '';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    $message = sanitize($_POST["message"]);

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO ContactMessages (Name, Email, Message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        $info = '<div class="alert alert-success">Message sent successfully!</div>';
    } else {
        $info = '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
    }

    // Close statement
    $stmt->close();

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

    <body cz-shortcut-listen="true" class="contact-page">
        <?php include 'header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <?php include "navbar.php"; ?>
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4 py-4">
                    <div class="d-flex py-5 my-5 flex-column align-items-center justify-content-center">
                        <h2 class="libre-baskerville text-center fw-bold fs-30">Contact Us</h2>
                        <div class="row justify-content-center mt-3 mb-4 w-100">
                            <div class="col-md-6">
                                <div class="card bg-peach border-0 shadow">
                                    <div class="card-body">
                                        <?php echo $info; ?>
                                        <form method="POST" action="">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name:</label>
                                                <input type="text" class="form-control bg-peach border-secondary" id="name" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email:</label>
                                                <input type="email" class="form-control bg-peach border-secondary" id="email" name="email"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message:</label>
                                                <textarea class="form-control bg-peach border-secondary" id="message" name="message" rows="5"
                                                    required></textarea>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn bg-teapink">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="p-0 d-flex flex-column gap-2 justify-content-center list-unstyled">
                            <li>
                                <a href="#" class="fw-medium text-decoration-none"><i
                                        class="fa fa-phone me-2"></i>+123-456-7890</a>
                            </li>
                            <li>
                                <a href="#" class="fw-medium text-decoration-none"><i
                                        class="fa fa-globe me-2"></i>www.CollageEase.com</a>
                            </li>
                            <li>
                                <a href="#" class="fw-medium text-decoration-none"><i
                                        class="fab fa-linkedin me-2"></i>My Linked In</a>
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