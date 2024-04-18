<?php
session_start();

// https://auth-db749.hstgr.io/index.php?db=u956940883_collegeease
$servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "u956940883_collegeease"; // Change this to your MySQL username
$password = "Zc1s5];DY*"; // Change this to your MySQL password
$database = "u956940883_collegeease"; // Change this to the name of your MySQL database


// $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
// $username = "root"; // Change this to your MySQL username
// $password = "root"; // Change this to your MySQL password
// $database = "collageease_db"; // Change this to the name of your MySQL database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function isLoggedIn()
{
    return isset($_SESSION['ID']);
}

// Function to check if user is an admin
function isAdmin()
{
    return (isset($_SESSION['Role']) && $_SESSION['Role'] == 'admin');
}

// Function to check if user is an alumni
function isAlumni()
{
    return (isset($_SESSION['Role']) && $_SESSION['Role'] == 'alumni');
}

// Function to check if user is a student
function isStudent()
{
    return (isset($_SESSION['Role']) && $_SESSION['Role'] == 'student');
}

function getUsersCount($conn)
{
    $sql = "SELECT COUNT(*) AS totalUsers FROM users";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalUsers'];
}

// Function to get the count of posts
function getPostsCount($conn)
{
    $sql = "SELECT COUNT(*) AS totalPosts FROM posts";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalPosts'];
}

// Function to get the count of programs
function getProgramsCount($conn)
{
    $sql = "SELECT COUNT(*) AS totalPrograms FROM programs";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalPrograms'];
}

// Function to get the count of comments
function getCommentsCount($conn)
{
    $sql = "SELECT COUNT(*) AS totalComments FROM comments";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalComments'];
}

// Function to get the count of votes
function getVotesCount($conn)
{
    $sql = "SELECT COUNT(*) AS totalVotes FROM votes";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['totalVotes'];
}