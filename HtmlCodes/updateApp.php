<?php
include 'database.php';

$appId = $_POST['application_id'];
$status = $_POST['status'];

$query = "UPDATE application SET Status = ? WHERE ApplicationID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $status, $appId);

if ($stmt->execute()) {
    echo "Application updated successfully.";
} else {
    echo "Error updating application.";
}
?>