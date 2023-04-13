<?php include('./sign_up_process.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/style_sign_in.css">
    <script src="https://kit.fontawesome.com/2afeadeeee.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form method = "POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div>

                    <div class="input-field" id="EmailField">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <p>Forgot Password? <a href="#">Click here!</a></p>
                </div>
                <div class="btn-field">
                    <!-- <input type="submit" value ="Sign Up" id="signupbtn" > -->
                    <button type="submit" id="signupbtn">Sign Up</button>
                    <button class="disable" id="signinbtn">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        let signinBtn = document.getElementById("signinbtn");

        signinBtn.addEventListener("click", function() {
        window.location.href = "./login.php";
});

    </script>
<!-- 
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
            // window.location.href = "spessa.html";
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
            // window.location.href = "spessa.html";
          });
          

        // Helper function to validate email address
        function isValidEmail(email) {
            // Use a regular expression to check if the email is valid
            let emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/
            return emailRegex.test(email);
        } -->
    <!-- </script> -->
</body>

</html>