<?php
include("connect.php");



$sql = "SELECT * FROM tvseries";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}


// Set header to application/json
header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>