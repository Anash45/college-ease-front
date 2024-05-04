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
    $contactID = $_GET['delete'];

    // Delete the program from the database
    $sql = "DELETE FROM contactmessages WHERE ID = $contactID";

    if (mysqli_query($conn, $sql)) {
        // Redirect to success page or display success message
        $info = '<div class="alert alert-success">Message deleted successfully!</div>';
    } else {
        // Display error message
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
                        <h2 class="h2 page-title">Messages</h2>
                    </div>
                    <?php echo $info; ?>
                    <div class="table-responsive">
                        <table class="table text-center table-programs">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Received at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Query to select all records from the programs table
                                $sql = "SELECT * FROM contactmessages";

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
                                        echo '<a href="?delete=1" onclick="return confirm(\'Do you really want to delete this?\')" class="btn btn-sm rounded-5 btn-danger ms-1"><i class="fa fa-trash"></i></a>';
                                        echo '</td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">CEM-' . $formatted_id . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['Name'] . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['Email'] . ' University</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['Message'] . '</span></td>';
                                        echo '<td><span class="badge bg-primary fs-10">' . date('h:i a d M, Y', strtotime($row['CreatedAt'])) . '</span></td>';
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
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>