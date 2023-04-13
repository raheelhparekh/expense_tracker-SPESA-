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
                    <!-- <div class="input-field" id="nameField">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div> -->

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
                    <!-- <a href="sign_up.php">
                        
                    </a> -->
                    <button type="submit" id="signupbtn">Sign Up </button>
                    
                    <button class="disable" id="signinbtn">Sign In <a href="spessa.php"></a></button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>