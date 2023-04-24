<?php
// Connect to the database
session_start();
$mysqli = new mysqli("localhost", "root", "", "miniproject");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if(!$_SESSION["user_id"]){
    header("location: /Parth/expense_tracker-SPESA-/frontend/login.php");
}
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data and escape any special characters
    $category = $mysqli->real_escape_string($_POST['budget_category']);
    $amount = $mysqli->real_escape_string($_POST['budget_amount']);
    $user_id = $_SESSION["user_id"];

    // Insert the data into the 'expense' table
    // $sql = "INSERT INTO expense (expense_date, category, amount, note) VALUES ('$date', '$category', '$amount', '$note')";
    $sql = "INSERT INTO `budget` (`budget_category`, `budget_amount`, `fk_user_id`) 
            VALUES ('$category', '$amount', '$user_id');";

    if ($mysqli->query($sql) === TRUE) {
        echo "Expense added successfully";
        header("location: /Parth/expense_tracker-SPESA-/frontend/budget_planner.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Budget Planner</title>
    <link rel="stylesheet" type="text/css" href="./css/wallet_budget.css" />
  </head>
  <body>
    <div id="container">
    <div id="image">
      <img src="img/wallet1.png" alt="" class="img">
    </div>

    <h2>Add Expense</h2><br>
    <div class = "budget-container">
            <form id="budget-form" method="POST">
                <div class="form-row">
                    <div class="form-col">
                        <label for="amount">Amount:</label>
                        <input type="number" id="budget_amount" name="budget_amount" required>
                    </div>
                    <div class="form-col">
                        <label for="category">Category:</label>
                        <select id="budget_category" name="budget_category" required>
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
                <input type="submit" name="submit" value="Add Budget">
            </form>
  
        <button onclick="setBudgets()">Set Budget</button>
    </div>
</div>
    <script src=""></script>
  </body>
</html>