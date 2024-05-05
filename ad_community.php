<?php
// Include the database connection file
require_once "db_conn.php";
if (!isLoggedIn()) {
    header('location:login.php');
}
$userID = $_SESSION['ID'];
// Initialize response variable
$info = "";
if (isset($_GET['delete'])) {
    // Get the program ID from the URL parameter
    $post_id = $_GET['delete'];
    // Check if the user is the owner of the post
    if (!isAdmin() && !isAlumni()) {
        // Query to check if the user is the owner of the post
        $checkQuery = "SELECT * FROM posts WHERE postID = $post_id AND userID = $userID"; // Replace 'USER_ID' with the actual user ID
        $result = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($result) == 0) {
            // If the user is not the owner of the post, redirect or show an error message
            $info = '<div class="alert alert-danger">You are not authorized to update this post!</div>';
        }
    }

    // Delete the program from the database
    $sql = "DELETE FROM posts WHERE postID = $post_id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to success page or display success message
        $info = '<div class="alert alert-success">Post deleted successfully!</div>';
    } else {
        // Display error message
        $info = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
} else
    if (isset($_GET['status'])) {
        // Get the program ID from the URL parameter
        $post_id = $_GET['ID'];
        $status = $_GET['status'];
        // Check if the user is the owner of the post
        if (isAdmin() || isAlumni()) {
            // Delete the program from the database
            $sql = "UPDATE posts SET status = '$status' WHERE postID = $post_id";

            if (mysqli_query($conn, $sql)) {
                // Redirect to success page or display success message
                $info = '<div class="alert alert-success">Post status changed successfully!</div>';
            } else {
                // Display error message
                $info = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
            }
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
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
                        <h2 class="h2 page-title">Posts</h2>
                        <button class="btn fw-bold fs-14 rounded-5 px-3 bg-peach py-2 border-0" data-bs-toggle="modal"
                            data-bs-target="#postModal">Add Post</button>
                    </div>
                    <?php echo $info; ?>
                    <div class="table-responsive">
                        <table class="table text-center table-programs">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch posts from the database based on user's role
                                if (isAdmin() || isAlumni()) {
                                    // Query to fetch all posts for admin
                                    $sql = "SELECT posts.*, users.Name, COUNT(comments.commentID) AS Comments
            FROM posts
            LEFT JOIN users ON posts.userID = users.ID
            LEFT JOIN comments ON posts.postID = comments.postID
            GROUP BY posts.postID";
                                } elseif (isStudent()) {
                                    // Query to fetch only user's posts
                                    // Replace 'USER_ID' with the actual user ID
                                    $sql = "SELECT posts.*, users.Name, COUNT(comments.commentID) AS Comments
            FROM posts
            LEFT JOIN users ON posts.userID = users.ID
            LEFT JOIN comments ON posts.postID = comments.postID
            WHERE posts.userID = '$userID'
            GROUP BY posts.postID";
                                }

                                // Execute the query
                                $result = mysqli_query($conn, $sql);

                                // Check if records exist
                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through each row in the result set
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $status = $row['status'] ? '<a href="?status=0&ID=' . $row['postID'] . '" class="btn btn-sm rounded-5 btn-warning mx-1" title="Disable"><i class="fa fa-times"></i></a>' : '<a href="?status=1&ID=' . $row['postID'] . '" class="btn btn-sm rounded-5 btn-success mx-1" title="Enable"><i class="fa fa-check"></i></a>';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<a href="edit-post.php?ID=' . $row['postID'] . '" class="btn btn-sm rounded-5 btn-primary"><i class="fa fa-edit"></i></a>';
                                        if (isAdmin() || isAlumni()) {
                                            echo $status;
                                        }
                                        echo '<a href="?delete=' . $row['postID'] . '" onclick="return confirm(\'Do you really want to delete this?\')" class="btn btn-sm rounded-5 btn-danger ms-1"><i class="fa fa-trash"></i></a>';
                                        echo '</td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">POST-' . $row['postID'] . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['Name'] . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['title'] . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . ($row['closed'] ? 'Closed' : 'Opened') . '</span></td>';
                                        echo '<td><span class="badge bg-tea text-dark rounded-5 px-3 py-2 fs-14">' . $row['Comments'] . '</span></td>';
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
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-peach">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method="POST" action="community.php">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control bg-transparent border-secondary" id="title" required
                                name="title">
                        </div>
                        <!-- Textarea -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Textarea</label>
                            <textarea class="form-control bg-transparent border-secondary" id="content" required
                                name="content" rows="3"></textarea>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn bg-teapink rounded-5 fw-medium" name="add_post">Submit</button>
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