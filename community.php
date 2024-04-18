<?php
// Include the database connection file
require_once "db_conn.php";
if(!isLoggedIn()){
    header('location:login.php');
}

$info = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_post'])) {
    // Define variables and initialize with empty values
    $title = $content = "";
    $userID = $_SESSION['ID']; // Assuming userID is stored in session

    // Process form data when the form is submitted
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);

    // Check if a post with the same title exists for the same user
    $sql_check_post = "SELECT * FROM posts WHERE title='$title' AND userID='$userID'";
    $result_check_post = mysqli_query($conn, $sql_check_post);

    if (mysqli_num_rows($result_check_post) > 0) {
        // Post with the same title already exists for the same user
        $info = '<div class="alert alert-danger">A post with the same title already exists for you.</div>';
    } else {
        // Insert the post into the database
        $sql_add_post = "INSERT INTO posts (title, content, userID) VALUES ('$title', '$content', '$userID')";

        if (mysqli_query($conn, $sql_add_post)) {
            // Post added successfully
            $info = '<div class="alert alert-success">Post added successfully!</div>';
        } else {
            // Error adding post
            $info = '<div class="alert alert-danger">Error adding post: ' . mysqli_error($conn) . '</div>';
        }
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
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4 py-4 gap-3">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <div>
                            <h2 class="h2 page-title lh-1 fw-bold courier-prime mb-0 text-red fs-30">The Community of
                                CollageEase</h2>
                            <p class="fw-medium mb-0">The area of the help center is for users to talk to each other.
                            </p>
                        </div>
                        <div>
                            <input type="text" placeholder="Search out articles..."
                                class="form-control bg-transparent border-dark">
                        </div>
                    </div>
                    <?php echo $info; ?>
                    <div class="community-posts pt-4">
                        <?php
                        // Fetch posts from the database, ordered by descending postID
                        $sql = "SELECT * FROM posts ORDER BY postID DESC";
                        $result = mysqli_query($conn, $sql);

                        // Check if any posts exist
                        if (mysqli_num_rows($result) > 0) {
                            // Loop through each post
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Extract post details
                                $postID = $row['postID'];
                                $title = $row['title'];
                                $content = $row['content'];
                                $userID = $row['userID'];
                                $createdAt = $row['createdAt'];
                                $closed = $row['closed'] ? '<span class="post-closed rounded-5 bg-red lh-1"><i class="fa fa-check"></i></span>' : '';

                                // Format date
                                $createdAtFormatted = date('h:i dS M, Y', strtotime($createdAt));

                                // Get user name (assuming it's stored in another table)
                                $sql_user = "SELECT Name FROM users WHERE ID=$userID";
                                $result_user = mysqli_query($conn, $sql_user);
                                $user = mysqli_fetch_assoc($result_user);
                                $userName = $user['Name'];

                                // Generate HTML markup for the post
                                echo '<a href="post-details.php?postID=' . $postID . '" class="post d-flex flex-column gap-1">';
                                echo '<div class="post-top d-flex align-items-center gap-3">';
                                echo '<h3 class="post-title fw-bold fs-24 courier-prime mb-0">' . $title . '</h3>';
                                echo $closed;
                                echo '</div>';
                                echo '<div class="post-bottom d-flex gap-3 align-items-center justify-content-between">';
                                echo '<p class="d-flex gap-2 fs-14 fw-medium mb-0"><span>' . $userName . '</span><span class="fw-bold">.</span><span>' . $createdAtFormatted . '</span></p>';
                                // Count comments for the post (assuming it's stored in another table)
                                $sql_comments = "SELECT COUNT(*) AS commentCount FROM comments WHERE postID=$postID";
                                $result_comments = mysqli_query($conn, $sql_comments);
                                $commentCount = mysqli_fetch_assoc($result_comments)['commentCount'];
                                echo '<p class="d-flex flex-column align-items-center justify-content-center mb-0 gap-2 fw-bold">';
                                echo '<span>' . $commentCount . '</span>';
                                echo '<span>Comments</span>';
                                echo '</p>';
                                echo '</div>';
                                echo '<div class="post-border"></div>';
                                echo '</a>';
                            }
                        } else {
                            // No posts found
                            echo '<p class="alert alert-danger">No posts found.</p>';
                        }

                        // Close connection
                        mysqli_close($conn);
                        ?>
                    </div>
                    <div class="text-center">
                        <button class="btn fw-bold fs-18 rounded-5 px-4 bg-peach py-3 border-0" data-bs-toggle="modal"
                            data-bs-target="#postModal">New Post?</button>
                        <p class="mb-0 fw-medium mt-2">Didn't find what you were looking for?</p>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-peach">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form method="POST" action="">
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