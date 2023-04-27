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
    $i_category = $mysqli->real_escape_string($_POST['income_category']);
    $i_amount = $mysqli->real_escape_string($_POST['income_amount']);
    $user_id = $_SESSION["user_id"];

    // Insert the data into the 'expense' table
    // $sql = "INSERT INTO expense (expense_date, category, amount, note) VALUES ('$date', '$category', '$amount', '$note')";
    $sql = "INSERT INTO `budget` (`budget_category`, `budget_amount`, `fk_user_id`) 
            VALUES ('$category', '$amount', '$user_id');";

    $sql1 = "INSERT INTO `income` (`income_category`, `income_amount`, `fk_user_id`) 
    VALUES ('$i_category', '$i_amount', '$user_id');";

    if ($mysqli->query($sql) === TRUE) {
        echo "Wallet added successfully";
        header("location: /Parth/expense_tracker-SPESA-/frontend/budget_planner.php");
    }
    else {
      echo "Error: " . $sql . "<br>" . $mysqli->error;
  }

    // Close the database connection
    $mysqli->close();
}
?>
 

<!DOCTYPE html>
<html>
  <head>
    <title>Wallet</title>
    <link rel="stylesheet" type="text/css" href="./css/wallet_budget.css" />
  </head>
  
  <body>
  <div class="header">
    <a href="./spessa.php">
      <img src="./img/logo1.jpg" alt="SPESA" height="70px" width="70px">
    </a>
    <a href="./budget_planner.php">
            <div class="wallet" id="walletField">
                <i class="fas fa-wallet"></i>
                <h3>Budget Planner </h3>
            </div>
        </a>
  </div>

      <div class = "form-container">
        <div class="input-area">
          <h1>Wallet</h1>
          <form id="budget-form" method="POST">
              <div class="form-row">
                  <div class="form-col">
                        <label for="amount">Budget Amount:</label>
                        <input type="number" id="budget_amount" name="budget_amount" required>
                  </div>
                    <div class="form-col">
                        <label for="category">Budget Category:</label>
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
              <div class="form-row">
                  <div class="form-col">
                        <label for="income_amount">Income Amount:</label>
                        <input type="number" id="income_amount" name="income_amount" min="0">
                  </div>
                    <div class="form-col">
                        <label for="category">Income Category:</label>
                        <select id="income_category" name="income_category">
                            <option value="" disabled selected>Select Category</option>
                            <option value="salary">Salary</option>
                            <option value="freelance">Freelance</option>
                            <option value="investments">Investments</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
              </div><br>
              <input type="submit" name="submit" value="Add Wallet" onclick="setBudgets()">
            </form>
</div>

</div>
  
    
<script src=""></script>

  </body>
</html>