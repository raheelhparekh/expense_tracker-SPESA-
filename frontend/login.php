<?php include('login_process.php')?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://kit.fontawesome.com/2afeadeeee.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign In</h1>
            <form method="POST">
                <div class="input-group">
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
                    <button id="signinbtn">Sign In</button>
                    <button class="disable" type="submit" id="signupbtn"><a href="./sign_up.php" style="color: white; text-decoration: none;">Sign Up</a></button>
                    
                </div>
            </form>
        </div>
    </div>
</body>

</html>