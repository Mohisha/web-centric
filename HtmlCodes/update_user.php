<?php
include 'database.php'; 

// if ($conn->connect_errno) {
//     echo json_encode(["error" => "Failed to connect to MySQL: " . $conn->connect_error]);
//     exit();
// }

$data = json_decode(file_get_contents("php://input"), true);
var_dump($data);


$id = $conn->real_escape_string($data['UserID']);
$username = $conn->real_escape_string($data['UserName']);
$contact = $conn->real_escape_string($data['Contact']);
$email = $conn->real_escape_string($data['Email']);
$role = $conn->real_escape_string($data['Role']);
$status = $conn->real_escape_string($data['Status']);

$query = "UPDATE user SET UserName='$username', Contact='$contact', Email='$email', Role='$role', Status='$status' WHERE UserID='$id'";

if ($conn->query($query)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Update failed: " . $conn->error]);
}
?>
