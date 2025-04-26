<?php
include 'database.php';

$appId = $_POST['application_id'];
$query = "DELETE FROM application WHERE ApplicationID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $appId);

if ($stmt->execute()) {
    echo "Application deleted successfully.";
} else {
    echo "Error deleting application.";
}
?>