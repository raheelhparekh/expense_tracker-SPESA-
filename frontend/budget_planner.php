<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "miniproject");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if(!$_SESSION["user_id"]){
    header("location: /Parth/expense_tracker-SPESA-/frontend/login.php");
}
if (isset($_POST['submit'])) {
    $date = $mysqli->real_escape_string($_POST['expense_date']);
    $category = $mysqli->real_escape_string($_POST['category']);
    $amount = $mysqli->real_escape_string($_POST['amount']);
    $note = $mysqli->real_escape_string($_POST['note']);
    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO `expense` (`expense_date`, `category`, `amount`, `note`, `fk_user_id`) 
            VALUES ('$date', '$category', '$amount', '$note', '$user_id');";

    if ($mysqli->query($sql) === TRUE) {
        echo "Expense added successfully";
        header("location: /Parth/expense_tracker-SPESA-/frontend/budget_planner.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../frontend/css/budget_planner.css">
    <script src="https://kit.fontawesome.com/2afeadeeee.js" crossorigin="anonymous"></script>
</head>


<body>
    <div class="header">
        <a href="./spessa.php">
            <img src="img/logo1.jpg" alt="SPESA" height="70px" width="70px">
        </a>
        <h1>Budget Planning</h1>
        <a href="./wallet_budget.php">
            <div class="wallet" id="walletField">
                <i class="fas fa-wallet"></i>
                <h3>Wallet</h3>
            </div>
        </a>
    </div>
    
        <div class="form-container">
            <div class="input-area">
                <h2>Add Expense</h2>
                <form id="expense-form" method="POST">
                    <div class="form-row">
                        <div class="form-col">
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="expense_date" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="form-col">
                            <label for="category">Category:</label>
                            <select id="category" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="groceries">Groceries</option>
                                <option value="utilities">Utilities</option>
                                <option value="rent">Rent</option>
                                <option value="transportation">Transportation</option>
                                <option value="entertainment">Entertainment</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="amount">Amount:</label>
                            <input type="number" id="amount" name="amount" required>
                        </div>
                        <div class="form-col">
                            <label for="note">Note:</label>
                            <input type="text" id="note" name="note">
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Add Expense">
                </form>
            </div>
                

<?php
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
<div class="chart-area">
    <div class="header1">
        <h2>Smart Statistics</h2>
    </div>

        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>';

    
echo '
</div>
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
    ';
    foreach ($categories as $key => $category) 
    {
    if (isset($budgets[$category]) && $amounts[$key] > $budgets[$category]) 
    {
        echo '
        <div class="message">
            --Total expenses for category ' . $category . ' have exceeded the budget amount of ' . $budgets[$category] . '
        .</div>
        ';
    }
    }

    ?>
    </body>
    
    <script src="js/budget_planner.js"></script>
    </html>