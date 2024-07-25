<?php
include 'connect.php';

// SQL query to fetch movie details
$sql = "SELECT name, poster_url FROM movies";
$result = $conn->query($sql);

$movies = [];

if ($result->num_rows > 0) {
    // Fetching all movie details into an array
    while($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
} else {
    echo "0 results";
}


?>