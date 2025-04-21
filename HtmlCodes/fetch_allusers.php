<?php
include 'database.php'; 

// if ($mysqli->connect_errno) {
//     echo json_encode(["error" => "Failed to connect to MySQL: " . $mysqli->connect_error]);
//     exit();
// }

$query = "SELECT UserID, UserName, Contact, Email, Role, Status FROM user ORDER BY UserID DESC";
$result = $conn->query($query);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>
