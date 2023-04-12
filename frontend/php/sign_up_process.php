<?php
include('db_connect.php');
session_start();
$errors = array();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // include ('db_connect.php');
    // $username = $_POST["username"];
    // $email = $_POST["email"];
    // $password = $_POST["password"];
    //     $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
    //     $result = mysqli_query($conn , $sql);

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        if (empty($username)) {
          array_push($errors, "Username is required");
        }
        if (empty($email)) {
          array_push($errors, "Email is required");
        }
        if (empty($password)) {
          array_push($errors, "Password is required");
        }
        $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
      
        if ($user) {
          if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
          }
      
          if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
          }
        }
      
        if (count($errors) == 0) {
          $hashpassword = md5($password);
      
          $query = "INSERT INTO users (username, email, password) 
                      VALUES('$username', '$email', '$hashpassword')";
          mysqli_query($db, $query);
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: spessa.html');
        }
}
?>