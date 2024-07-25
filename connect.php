<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "123456";
    $db_name = "newdb";
    $conn = new mysqli($db_server,$db_user,$db_pass, $db_name);

   

    if($conn->connect_error){
        echo "Not Connected".$conn->connect_error;
    }
?> 