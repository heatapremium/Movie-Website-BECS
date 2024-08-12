<?php
include("connect.php");
// register
if (isset($_POST['signUp'])) {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //$password = md5($password);
    echo "Pressed";

    $checkEmail = "SELECT * FROM users where email='$email'";
    $result = $conn->query($checkEmail);


    if ($result->num_rows> 0) {
        echo "Email already Exists";
    } else {
        $insertQuery = "INSERT INTO users(fname,lname,email,password) VALUES ('$firstName','$lastName','$email','$password')";
        if ($conn->query($insertQuery) == TRUE) {
            header("location: login.php");
        } else {
            echo "error:" . $conn->error;
        }
    }
}

// login
if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //$password = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: index.php");
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>