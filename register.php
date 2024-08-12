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
            <h1>Register</h1>
            <form method="post" name="registerForm" action="auth.php" onsubmit="return validateForm()">
                <div>
                <label for="fname">First Name</label>
                <input type="text" name="fname" id="fname" placeholder="First Name" required>
                </div>
                <div>
                <label for="lname">Last Name</label>
                <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                </div>
                <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="password" required>
                </div>
                <button type="submit" name="signUp">Register</button>
            </form>
            <p>Already have an Account? <a href="./login.php">Sign In</a></p>
        </div>
    </div>
    <script>
        function validateForm() {
            const fname = document.getElementById("fname").value;
            const lname = document.getElementById("lname").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            const namePattern = /^[A-Za-z]+$/;
            if (!namePattern.test(fname) || !namePattern.test(lname)) {
                alert("First Name and Last Name should only contain letters.");
                return false;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            const passwordPattern = /^(?=.*\d)[A-Za-z\d]{8,}$/;
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 8 characters long and contain at least one number.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>