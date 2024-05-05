<?php
// Include the database connection file
require_once "db_conn.php";
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
$info = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isAdmin()) {
    // Retrieve form data
    $question = $_POST['question'];
    $answer = $_POST['answer'];

    // Prepare the SQL statement to insert data into faqs table
    $sql = "INSERT INTO faqs (question, answer, createdAt) VALUES (?, ?, NOW())";

    // Prepare and bind parameters
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $question, $answer);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // FAQ data inserted successfully
            $info = '<div class="alert alert-success">FAQ added successfully!</div>';
        } else {
            // Error occurred while inserting data
            $info = '<div class="alert alert-danger">Error occurred while adding FAQ!</div>';
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Error occurred while preparing statement
        $info = '<div class="alert alert-danger">Error occurred while preparing statement!</div>';
    }
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
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4 py-4">
                    <?php echo $info; ?>
                    <div class="row">
                        <div class="col-lg-5 py-3">
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                                <?php
                                if (isAdmin()) {
                                    echo '<button type="button" class="btn bg-peach rounded-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Add FAQ
                                  </button>';
                                }
                                ?>
                                <h1 class="faq-title mb-3">FAQ</h1>
                                <p class="fw-semibold fs-20 mb-5">Frequently Asked Questions</p>
                                <p class="fw-medium fs-18">In case you had concerns , here are some frequently asked
                                    questions and answers to clear things up.</p>
                            </div>
                        </div>
                        <div class="col-lg-7 py-3 d-flex flex-column justify-content-center align-items-center">
                            <div class="accordion" id="accordionExample">
                                <?php
                                // Retrieve FAQs from the database
                                $sql = "SELECT * FROM faqs";
                                $result = mysqli_query($conn, $sql);

                                // Check if there are FAQs available
                                if (mysqli_num_rows($result) > 0) {
                                    $firstItem = true; // Flag to track the first FAQ item
                                
                                    // Loop through each FAQ
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Format the FAQ data
                                        $question = $row['question'];
                                        $answer = $row['answer'];

                                        // Output the FAQ in the desired format
                                        echo '<div class="accordion-item">';
                                        echo '<h2 class="accordion-header" id="heading' . $row['fId'] . '">';
                                        echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $row['fId'] . '" aria-expanded="true" aria-controls="collapse' . $row['fId'] . '">' . $question . '</button>';
                                        echo '</h2>';
                                        echo '<div id="collapse' . $row['fId'] . '" class="accordion-collapse collapse';

                                        // Add the 'show' class to the first FAQ item
                                        if ($firstItem) {
                                            echo ' show';
                                            $firstItem = false; // Reset the flag after adding 'show' class to the first item
                                        }

                                        echo '" aria-labelledby="heading' . $row['fId'] . '" data-bs-parent="#accordionExample">';
                                        echo '<div class="accordion-body">';
                                        echo '<p class="m-0">' . $answer . '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    // Display a message if no FAQs are found
                                    echo '<div class="alert alert-info">No FAQs found.</div>';
                                }

                                // Close the database connection
                                mysqli_close($conn);
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-peach">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="faqForm" method="POST" action="">
                        <div class="mb-3">
                            <label for="question" class="form-label">Question</label>
                            <input type="text" class="form-control border-dark bg-peach" id="question" name="question"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer</label>
                            <textarea class="form-control border-dark bg-peach" id="answer" name="answer" rows="4"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn bg-teapink rounded-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>