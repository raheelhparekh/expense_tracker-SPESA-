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
  <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  #container{
    display: flex;
    /* border: 2px solid red; */
    width: 100%;
    height: 100%;
    background-color:#e0ecff;
    padding: 20px 20px 20px 20px;
  }
  #image{
    /* border: 2px solid  blueviolet; */
    width: 40%;
    background-color: #e0ecff;
  }
  .img{
    width: 80%;
    height: 80%;
    /* border: 2px solid green; */
    margin: 50px;
  }
  #content-container{
    width: 70%;
  }
  /* Heading styles */
  
  h2 {
    font-weight: bold;
    text-align: center;
    margin-top: 30px;
    /* margin-bottom: 30px; */
    font-size: 35px;
    color: #333;
    text-shadow: 2px 2px #fff;
    height:fit-content;
    font-weight: bold;
    text-align: center;
    margin-bottom: 0px;
    /* margin-top: 30px; */
    font-size: 50px;
    /* margin-bottom: 60px; */
    color: rgb(8, 117, 136);
    position: relative;
  }
  
  input[type="number"] {
    position: flex;
    width: 250px;
    height: 50px;
    left: 48px;
    top: 129px;
    background: white;
    border-radius: 15px;
    text-align: center;
    font-size: 20px;
    /* border: 2px solid red; */

}


.form-row {
    display: flex;
    flex-wrap: wrap;
    margin: 10px 0;
}

.form-col {
    flex: 1;
    margin-right: 10px;
    /* adjust as needed */
}

.form-col:last-child {
    margin-right: 0;
}


select {
    position: flex;
    width: 250px;
    height: 50px;
    left: 48px;
    top: 129px;
    background: #D9D9D9;
    border-radius: 15px;
    text-align: center;
    font-size: 20px;
}

select:hover,
select:focus {
    border-color: #aaa;
}

select option {
    font-size: 16px;
    padding: 10px;
    background-color: #fff;
    color: #555;
}

select option:checked {
    background-color: #007bff;
    color: #fff;
}

label {
    display: inline-block;
    width: 100px;
    /* adjust as needed */
}

input {
    display: inline-block;
    width: calc(100% - 100px); /* adjust as needed */
    margin-left: 10px; /* adjust as needed */
}



label {
    margin-top: 10px;
}
  
  /* Button styles */
  
  button {
    display: block;
    margin: 0 auto;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    width: fit-content;
    height: fit-content;
  }
  
  button:hover {
    background-color: #0062cc;
  }
  
  /* Container styles */

  
.budget-container {
    background-color: #e0ecff;
    /* border: 2px solid red; */
    /* display: flex; */
    width:20%;
    flex-direction:row;
    flex:1;
    /* justify-content: left; */
    /* align-items: center; */
    /* margin-bottom: 20px; */
    border-radius: 5px;
    font-family: 'Poppins', sans-serif;
    font-size: 20px;
    font-weight: bold;
    height: fit-content;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 10px 10px 10px 10px;
    margin-top: 20%;
  }
  
  #income-container label {
    margin-right: 10px;
    margin-left: 5%;
  }
  
  #income-container select {
    margin-left: 10px;
  }
  
  /* Select styles */
  
  #budget_category{
    position: flex;
    width: 250px;
    height: 50px;
    left: 48px;
    top: 129px;
    background: white;
    border-radius: 15px;
    text-align: center;
    font-size: 20px;

  }
  .form-row{
    justify-content:space-between;
  }
  select {
    width: 50%;
    height: 40px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    font-size: 16px;
    margin-bottom: 10px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    appearance: none;
  }
  
  select:hover,
  select:focus {
    border-color: #aaa;
  }
  
  select option {
    font-size: 16px;
    padding: 10px;
    background-color: #fff;
    color: #555;
  }
  
  select option:checked {
    background-color: #007bff;
    color: #fff;
  }
  .form-row{
    /* display:flex; */
    justify-content:space-between;
    /* width:10%; */
  }
  
  /* Label styles */
  
  label {
    /* display: block; */
    /* border: 2px solid red; */
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
  }
  </style>
  <body>
      <h2>Set Budget</h2><br>
      <div id="container">
    <div id="image">
      <img src="img/wallet1.png" alt="" class="img">
    </div>

    <div class = "budget-container">
            <form id="budget-form" method="POST">
                <div class="form-row">
                    <div class="form-col">
                        <label for="amount">Amount:</label> <br>
                        <input type="number" id="budget_amount" name="budget_amount" required>
                    </div>
                    <div class="form-col">
                        <label for="category">Category:</label> <br>
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
                <button type="submit" name="submit" value="Add Budget" onclick="setBudgets()">Set Budget </button>
            </form>
  
        <!-- <button onclick="setBudgets()">Set Budget</button> -->
    </div>
</div>
    <script src=""></script>
  </body>
</html>