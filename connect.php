<?php

// Allow from any origin
header("Access-Control-Allow-Origin: *");
// Allow specific methods
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type, Authorization");
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "root";
    $db_name = "newdb";
    $conn = new mysqli($db_server,$db_user,$db_pass, $db_name);

   

    if($conn->connect_error){
        echo "Not Connected".$conn->connect_error;
    }
?> 