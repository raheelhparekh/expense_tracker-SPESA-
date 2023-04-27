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
    $category = $mysqli->real_escape_string($_POST['income_category']);
    $amount = $mysqli->real_escape_string($_POST['income_amount']);
    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO `income` (`income_category`, `income_amount`, `fk_user_id`) 
            VALUES ('$category', '$amount', '$user_id');";

    if ($mysqli->query($sql) === TRUE) {
        echo "Income added successfully";
        header("location: /Parth/expense_tracker-SPESA-/frontend/wallet.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Income Wallet</title>
    <link rel="stylesheet" type="text/css" href="css/wallet.css" />
  </head>
  <body>
    <form method = "POST">
      <div id="container">
        <div id="image">
          <img src="img/wallet1.png" alt="" class="img">
        </div>
        <div id="content-container">
        <h1>INCOME DATA</h1>
        <div id="income-container">
          <label for="income-amount">Income Amount:</label>
          <input type="number" id="income_amount" name="income_amount" min="0">
          <label for="income_category">Income Category:</label>
          <select id="income_category" name="income_category">
            <option value="salary">Salary</option>
            <option value="freelance">Freelance</option>
            <option value="investments">Investments</option>
            <option value="other">Other</option>
          </select>
        </div>
        <button type = "submit" name="submit" value="Add Income">Add Income</button>
      </div>
    </form>
    <script src="./js/wallet.js"></script>
  </body>
</html>