<?php
header('Content-Type: application/json');
include 'database.php';

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get job ID from request
$jobId = isset($_POST['JobID']) ? $_POST['JobID'] : '';

if ($jobId <= 0) {
    echo json_encode(['error' => 'Invalid Job ID']);
    $conn->close();
    exit;
}

// Delete the job
$sql = "DELETE FROM jobs WHERE JobID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $jobId);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Job deleted successfully']);
} else {
    echo json_encode(['error' => 'Error deleting job: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>