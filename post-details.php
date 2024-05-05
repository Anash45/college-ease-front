<?php
require 'db_conn.php';
if(!isLoggedIn()){
    header('location:login.php');
}
// Check if the form is submitted
$info = '';
if (isset($_GET['postID'])) {
    $postID = mysqli_real_escape_string($conn, $_GET['postID']);
    // Fetch post details from the database
    $sql_post1 = "SELECT * FROM posts WHERE postID=$postID";
    $result_post = mysqli_query($conn, $sql_post1);
    $post = mysqli_fetch_assoc($result_post);
    if (!empty($post)) {
        $closed1 = $post['closed'];
    }
} else {
    header("Location: community.php");
}
if (isset($_GET['postID']) && isset($_GET['close'])) {
    $postID = $_GET['postID']; // Get the postID from the URL
    $close = $_GET['close']; // Get the close parameter from the URL

    // Update the closed column of the post
    $sql_update_closed = "UPDATE posts SET closed=$close WHERE postID=$postID";

    if (mysqli_query($conn, $sql_update_closed)) {
        // Closed status updated successfully
        $info = '<div class="alert alert-success">Closed status updated successfully!</div>';
    } else {
        // Error updating closed status
        $info = '<div class="alert alert-danger">Error updating closed status: ' . mysqli_error($conn) . '</div>';
    }
}
if (isset($_GET['info']) && $_GET['info'] == 1) {
    $info = '<div class="alert alert-success">Vote added successfully!</div>';
} elseif (isset($_GET['info']) && $_GET['info'] == 2) {
    $info = '<div class="alert alert-success">Vote removed successfully!</div>';
}
// Check if postID and vote are set in the URL parameters
if (isset($_GET['postID']) && isset($_GET['vote'])) {
    $postID = $_GET['postID']; // Get the postID from the URL
    $commentID = $_GET['vote']; // Get the commentID from the URL
    if (!$closed1) {
        // Check if the user has already voted for this comment
        $userID = $_SESSION['ID']; // Assuming userID is stored in session
        $sql_check_vote = "SELECT * FROM votes WHERE commentID=$commentID AND userID=$userID";
        $result_check_vote = mysqli_query($conn, $sql_check_vote);

        if (mysqli_num_rows($result_check_vote) > 0) {
            // User has already voted for this comment, so remove the vote
            $sql_remove_vote = "DELETE FROM votes WHERE commentID=$commentID AND userID=$userID";

            if (mysqli_query($conn, $sql_remove_vote)) {
                // Vote removed successfully
                header('location:post-details.php?postID=' . $postID . '&info=2');
            } else {
                // Error removing vote
                $info = '<div class="alert alert-danger">Error removing vote: ' . mysqli_error($conn) . '</div>';
            }
        } else {
            // User has not voted for this comment, so add the vote
            $sql_add_vote = "INSERT INTO votes (commentID, userID) VALUES ($commentID, $userID)";

            if (mysqli_query($conn, $sql_add_vote)) {
                // Vote added successfully
                header('location:post-details.php?postID=' . $postID . '&info=1');
            } else {
                // Error adding vote
                $info = '<div class="alert alert-danger">Error adding vote: ' . mysqli_error($conn) . '</div>';
            }
        }
    } else {
        $info = '<div class="alert alert-danger">Post is closed.</div>';
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_comment'])) {
    // Check if postID is set in the URL parameter
    if (isset($_GET['postID'])) {
        $postID = $_GET['postID']; // Get the postID from the URL

        if (!$closed1) {
            // Define variables and initialize with empty values
            $commentContent = "";

            // Process form data when the form is submitted
            $commentContent = mysqli_real_escape_string($conn, $_POST["comment"]);

            // Insert the comment into the database
            $userID = $_SESSION['ID']; // Assuming userID is stored in session
            $sql_insert_comment = "INSERT INTO comments (content, userID, postID) VALUES ('$commentContent', '$userID', '$postID')";

            if (mysqli_query($conn, $sql_insert_comment)) {
                // Comment added successfully
                $info = '<div class="alert alert-success">Comment added successfully!</div>';
            } else {
                // Error adding comment
                $info = '<div class="alert alert-danger">Error adding comment: ' . mysqli_error($conn) . '</div>';
            }
        } else {
            $info = '<div class="alert alert-danger">Post is closed.</div>';
        }
    } else {
        // PostID parameter not set
        $info = '<div class="alert alert-danger">PostID parameter not set.</div>';
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
                <main class="col-md-8 ms-sm-auto col-lg-9 px-md-4 py-4 gap-3">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                        <div>
                            <h2 class="h2 page-title lh-1 fw-bold courier-prime mb-0 text-red fs-30">The Community of
                                CollageEase</h2>
                            <p class="fw-medium mb-0">The area of the help center is for users to talk to each other.
                            </p>
                        </div>
                    </div>
                    <?php echo $info; ?>
                    <div class="community-posts pt-4">
                        <?php
                        // Check if the post ID is set in the URL parameter
                        if (isset($_GET['postID'])) {
                            $postID = mysqli_real_escape_string($conn, $_GET['postID']);

                            // Fetch post details from the database
                            $sql_post = "SELECT * FROM posts WHERE postID=$postID";
                            $result_post = mysqli_query($conn, $sql_post);

                            // Check if the post exists
                            if (mysqli_num_rows($result_post) == 1) {
                                // Fetch post details
                                $row_post = mysqli_fetch_assoc($result_post);
                                $title = $row_post['title'];
                                $content = $row_post['content'];
                                $userID = $row_post['userID'];
                                $createdAt = $row_post['createdAt'];

                                // Format date
                                $createdAtFormatted = date('M d, Y h:i A', strtotime($createdAt));

                                // Fetch user name (assuming it's stored in another table)
                                $sql_user = "SELECT Name FROM users WHERE ID=$userID";
                                $result_user = mysqli_query($conn, $sql_user);
                                $user = mysqli_fetch_assoc($result_user);
                                $userName = $user['Name'];
                                // Check if post is closed
                                $closed = $row_post['closed'];

                                if ($closed || $_SESSION['ID'] !== $userID) {
                                    $close_btn = '';
                                } else {
                                    $close_btn = '<a class="btn btn-danger rounded-5" href="?postID=' . $postID . '&close=1">Close Post</a>';
                                }
                                // Display post details
                                echo '<article class="card p-3 mb-3 rounded-4">';
                                echo '<div class="post-top d-flex align-items-start gap-3"><h1 class="mb-0 flex-grow-1 fw-bold courier-prime fs-30">' . $title . '</h1>' . $close_btn . '</div>';
                                echo '<p class="mb-3 fs-14 fw-medium"><i>' . $userName . ' - ' . $createdAtFormatted . '</i></p>';
                                echo '<div class="fw-medium">';
                                echo '<p class="mb-0">' . nl2br($content) . '</p>';
                                echo '</div>';
                                echo '</article>';


                                // Display comment form if post is not closed
                                if (!$closed) {
                                    echo '<form class="mb-4" method="POST" action="?postID=' . $postID . '">';
                                    echo '<div class="mb-3">';
                                    echo '<textarea class="form-control form-control-sm bg-peach" placeholder="Add Comment..." id="comment" name="comment" rows="2"></textarea>';
                                    echo '</div>';
                                    echo '<button type="submit" class="btn btn-sm px-4 fs-12 rounded-5 fw-semibold bg-peach py-2 lh-1" name="add_comment">Submit</button>';
                                    echo '</form>';
                                }

                                // Fetch comments for the post
                                $sql_comments = "SELECT * FROM comments WHERE postID=$postID ORDER BY commentID DESC";
                                $result_comments = mysqli_query($conn, $sql_comments);

                                // Display comments
                                echo '<section class="p-4 bg-peach rounded-4">';
                                echo '<h2 class="mb-3 fs-20 fw-bold">Comments</h2>';
                                echo '<div class="comments d-flex flex-column gap-3">';
                                if (mysqli_num_rows($result_comments) > 0) {
                                    while ($row_comment = mysqli_fetch_assoc($result_comments)) {
                                        $commentID = $row_comment['commentID'];
                                        $commentContent = $row_comment['content'];
                                        $commentUserID = $row_comment['userID'];
                                        $commentCreatedAt = $row_comment['createdAt'];

                                        // Format comment date
                                        $commentCreatedAtFormatted = date('M d, Y h:i A', strtotime($commentCreatedAt));

                                        // Fetch user name for comment
                                        $sql_comment_user = "SELECT Name FROM users WHERE ID=$commentUserID";
                                        $result_comment_user = mysqli_query($conn, $sql_comment_user);
                                        $comment_user = mysqli_fetch_assoc($result_comment_user);
                                        $commentUserName = $comment_user['Name'];

                                        // Fetch number of votes for the comment
                                        $sql_votes_count = "SELECT COUNT(*) AS voteCount FROM votes WHERE commentID=$commentID";
                                        $result_votes_count = mysqli_query($conn, $sql_votes_count);
                                        $voteCount = mysqli_fetch_assoc($result_votes_count)['voteCount'];

                                        // Display comment
                                        echo '<div class="card border-danger overflow-hidden">';
                                        echo '<div class="card-body bg-light shadow-sm py-2 px-3">';
                                        echo '<p class="card-text mb-0 fs-14 fw-semibold text-black">' . nl2br($commentContent) . '</p>';
                                        echo '<p class="card-text"><small class="text-muted">' . $commentUserName . ' - ' . $commentCreatedAtFormatted . '</small></p>';
                                        echo '<div class="d-flex align-items-center gap-2"><a href="?postID=' . $postID . '&vote=' . $commentID . '" class="btn btn-sm btn-outline-success"><i class="fa fa-thumbs-up"></i></a><span> ' . $voteCount . '</span></div>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p class="alert alert-danger">No comments found.</p>';
                                }
                                echo '</div>';
                                echo '</section>';
                            } else {
                                // Post not found
                                echo '<p class="alert alert-danger">Post not found.</p>';
                            }
                        } else {
                            // Post ID parameter not set
                            echo '<p class="alert alert-danger">Post ID parameter not set.</p>';
                        }

                        // Close connection
                        mysqli_close($conn);
                        ?>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>

</html>