<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
</head>

<body>

    <h1> Register</h1>
    <form method="post" action="register.php">
        <input type="text" name="fname" id="fname" placeholder="First Name" required>
        <br>
        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
        <br>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="password" required>
        <br>
        <input type="submit" value="Sign Up" name="signUp">
    </form>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h1> Register</h1>
    <form method="post" action ="register.php">

        <input type="email" name="email" id="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" id="password" placeholder="password" required>
        <br>
        <input type="submit" value="Sign In" name="signIn">
    </form>

</body>

</html>