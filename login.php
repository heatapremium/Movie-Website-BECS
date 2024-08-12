<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEFLEX</title>
    <link rel="stylesheet" href="./css/style.min.css">
</head>
<body>
<div class="container">
    <div class="register-cont">
        <h1>Login</h1>
        <form method="post" action ="auth.php" onsubmit="return validateForm()">
        <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="password" required>
        </div>
        <button type="submit" name="signIn">Login</button>
    </form>
    <p>Don't have an Account? <a href="./register.php">Register</a></p>
    </div>
</div>
<script>
        function validateForm() {
            const email = document.getElementById("email").value;

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true;
        }
    </script>
</body>
</body>
</html>