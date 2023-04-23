<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db_connect.php');

if(isset($_POST['submit'])){
  $expense_date = $_POST['expense_date'];
  $amount = $_POST['amount'];
  $user_id = $_SESSION['user_id'];
  $note = $_POST['note'];

  $query = "INSERT INTO expense (expense_date , amount , user_id , note) 
            VALUES ('$expense_date', '$amount' , '$user_id' , '$note')";
  $result = $db->query($query);

  if($result) {
    header("Location: budget_planner.php");
    exit();
  } else {
    echo "Error: " . $db->error;
  }
}
$db->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Expense Tracker</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/budget_planner.css">
    <script src="https://kit.fontawesome.com/2afeadeeee.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
        <a href="./spessa.php">
            <img src="img/logo1.jpg" alt="SPESA" height="70px" width="70px">
        </a>
        <h1>Budget Planning</h1>
        <a href="./wallet.php">
            <div class="wallet" id="walletField">
                <i class="fas fa-wallet"></i>
                <h3>Wallet</h3>
            </div>
        </a>
    </div>
    <div class="container">
        <div class="form-container"><br><br><br>
            <h2>Add Expense</h2><br>
            <form id="expense-form" method = "POST">
                <div class="form-row">
                    <div class="form-col">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="expense_date" required>
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
                <br>

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
                <br>
                <input type="submit" name="submit" value="Add Expense">
            </form>
        </div>

        <div class="chart-container">
            <h2>Expenses By Category</h2>
            <canvas id="pie-chart"></canvas>
        </div>

        <div id="budget-container">
            <h2>Expense vs Budget Comparison</h2>
            <canvas id="budget-chart"></canvas>
        </div>
    </div>
    
    <script src="js/budget_planner.js"></script>
</body>
</html>