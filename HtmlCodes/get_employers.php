<?php
header('Content-Type: application/json');
include 'database.php'; 

$sql = "SELECT * FROM employer";
$result = mysqli_query($conn, $sql);

$employers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $employers[] = $row;
}

echo json_encode(['status' => 'success', 'data' => $employers]);
?>
