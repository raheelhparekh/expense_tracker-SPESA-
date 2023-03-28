<?php
$showAlert = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $err = "";
    include 'frontend/db_connect.php';
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $exists = false;
    if($exists == false)
    {
        $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('$username', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $showAlert = true;
        }
    }    
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/style_sign_in.css">
    <script src="https://kit.fontawesome.com/2afeadeeee.js" crossorigin="anonymous"></script>
</head>

<body>
<?php
    if($showAlert)
    {
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Your Account has been created.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <span aria-hidden = "true">&times;</span>
        </div>';
    }
?> 

    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form>
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" required>
                    </div>

                    <div class="input-field" id="EmailField">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" required>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" required>
                    </div>
                    <p>Forgot Password? <a href="#">Click here!</a></p>
                </div>
                <div class="btn-field">
                    <!-- <input type="submit" value ="Sign Up" id="signupbtn" > -->
                    <button type="button" input type="submit" id="signupbtn">Sign Up</button>
                    <button type="button" class="disable" id="signinbtn">Sign In</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        let signupbtn = document.getElementById("signupbtn");
        let signinbtn = document.getElementById("signinbtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");


        signinbtn.onclick = function () {
            nameField.style.maxHeight = "0";
            title.innerHTML = "Sign In";
            signupbtn.classList.add("disable");
            signinbtn.classList.remove("disable");

        }

        signupbtn.onclick = function () {
            nameField.style.maxHeight = "60px";
            title.innerHTML = "Sign Up";
            signupbtn.classList.remove("disable");
            signinbtn.classList.add("disable");
        }

        ///////////////////////////////////////////////
        let usernameField = document.querySelector("#nameField input");
        let emailField = document.querySelector("#EmailField input");
        let passwordField = document.querySelector("#EmailField + .input-field input");
        let signupBtn = document.getElementById("signupbtn");
        let signinBtn = document.getElementById("signinbtn");

        //// Add click event listeners to the buttons
        //signupBtn.addEventListener("click", function (event) {
        //    // Prevent the default form submission behavior
        //    event.preventDefault();
//
        //    if (usernameField.value.trim() === "") {
        //        alert("Please enter a username.");
        //        return;
        //    }
        //    if (emailField.value.trim() === "") {
        //        alert("Please enter an email address.");
        //        return;
        //    }
        //    if (!isValidEmail(emailField.value.trim())) {
        //        alert("Please enter a valid email address.");
        //        return;
        //    }
        //    if (passwordField.value.trim() === "") {
        //        alert("Please enter a password.");
        //        return;
        //    }
//
        //    // If all inputs are valid, submit the form
        //    //alert("Sign up successful!");
        //    window.location.href = "index.html";
//
        //});
//
        //signinBtn.addEventListener("click", function (event) {
        //    // Prevent the default form submission behavior
        //    event.preventDefault();
//
        //    if (emailField.value.trim() === "") {
        //        alert("Please enter an email address.");
        //        return;
        //    }
        //    if (!isValidEmail(emailField.value.trim())) {
        //        alert("Please enter a valid email address.");
        //        return;
        //    }
        //    if (passwordField.value.trim() === "") {
        //        alert("Please enter a password.");
        //        return;
        //    }
//
        //    // If all inputs are valid, submit the form
        //    alert("Sign in successful!");
        //    window.location.href = "index.html";
        //    
        //});

        signupBtn.addEventListener("click", function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();
          
            // Check if any of the input fields are empty
            if (usernameField.value.trim() === "" || emailField.value.trim() === "" || passwordField.value.trim() === "") {
              return;
            }
          
            // Validate the input fields
            if (!isValidEmail(emailField.value.trim())) {
              alert("Please enter a valid email address.");
              return;
            }
          
            // If all inputs are valid, submit the form
            window.location.href = "spessa.php";
          });
          
          signinBtn.addEventListener("click", function (event) {
            // Prevent the default form submission behavior
            event.preventDefault();
          
            // Check if any of the input fields are empty
            if (emailField.value.trim() === "" || passwordField.value.trim() === "") {
              return;
            }
          
            // Validate the input fields
            if (!isValidEmail(emailField.value.trim())) {
              alert("Please enter a valid email address.");
              return;
            }
          
            // If all inputs are valid, submit the form
            window.location.href = "spessa.php";
          });
          

        // Helper function to validate email address
        function isValidEmail(email) {
            // Use a regular expression to check if the email is valid
            let emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/
            return emailRegex.test(email);
        }
    </script>
</body>

</html>