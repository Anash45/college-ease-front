<?php
// Include the database connection file
require_once "db_conn.php";
if(!isAdmin()){
    header('location:login.php');
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
                    <div class="bg-peach p-4 text-center">
                        <canvas id="myChart" class="mx-auto w-100" height="400"></canvas>
                    </div>
                </main>
            </div>
        </div>
    </body>
    <script src="./assets/dist/js/jquery.min.js"></script>
    <script src="./assets/dist/js/bootstrap.min.js"></script>
    <script src="./assets/dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php
    $totalUsers = getUsersCount($conn);
    $totalPosts = getPostsCount($conn);
    $totalPrograms = getProgramsCount($conn);
    $totalComments = getCommentsCount($conn);
    $totalVotes = getVotesCount($conn);
    ?>
    <script>
        // Function to render the chart using Chart.js
        function renderChart() {
            const ctx = document.getElementById('myChart').getContext('2d');

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Users', 'Programs', 'Posts', 'Comments', 'Votes'],
                    datasets: [{
                        label: 'Website Statistics',
                        data: [<?php echo $totalUsers; ?>, <?php echo $totalPrograms; ?>, <?php echo $totalPosts; ?>, <?php echo $totalComments; ?>, <?php echo $totalVotes; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(55, 199, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(55, 199, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Fetch website statistics and render the chart
        renderChart();
    </script>

</html>