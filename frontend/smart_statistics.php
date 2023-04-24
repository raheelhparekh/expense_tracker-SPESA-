<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "miniproject");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if(!$_SESSION["user_id"]){
    header("location: /Parth/expense_tracker-SPESA-/frontend/login.php");
}

// Fetch expense data from database
$sql = "SELECT category, SUM(amount) AS total_amount FROM expense WHERE fk_user_id = {$_SESSION['user_id']} GROUP BY category;";
$result = $mysqli->query($sql);

$categories = [];
$amounts = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row['category'];
    $amounts[] = $row['total_amount'];
}

// Fetch budget data from database
$sql = "SELECT budget_category, budget_amount FROM budget WHERE fk_user_id = {$_SESSION['user_id']};";
$result = $mysqli->query($sql);

$budgets = [];

while ($row = $result->fetch_assoc()) {
    $budgets[$row['budget_category']] = $row['budget_amount'];
}

$mysqli->close();

echo '
<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/smart_statistics.css">
    <script src="https://kit.fontawesome.com/2afeadeeee.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
        <a href="./spessa.php">
            <img src="img/logo1.jpg" alt="SPESA" height="70px" width="70px">
        </a>
        <h1>Smart Statistics</h1>
    </div>

    <div class="container">
        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>';

foreach ($categories as $key => $category) {
    if (isset($budgets[$category]) && $amounts[$key] > $budgets[$category]) {
        echo '<div class="message">Total expenses for category ' . $category . ' have exceeded the budget amount of ' . $budgets[$category] . '.</div>';
    }
}

echo '
    </div>

    <script>
        var ctx = document.getElementById("myChart").getContext("2d");
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ' . json_encode($categories) . ',
                datasets: [{
                    label: "Total Expenses by Category",
                    data: ' . json_encode($amounts) . ',
                    backgroundColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56",
                        "#8B008B",
                        "#2F4F4F",
                        "#696969"
                    ],
                    borderColor: [
                        "#FF6384",
                        "#36A2EB",
                        "#FFCE56",
                        "#8B008B",
                        "#2F4F4F",
                        "#696969"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>';
?>
