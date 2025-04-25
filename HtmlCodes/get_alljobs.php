<?php
// get_jobs.php - Fetches all jobs from the database
include 'database.php'; 

// Check connection
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get all jobs
$sql = "SELECT * FROM jobs ORDER BY DatePosted DESC";
$result = $conn->query($sql);

if ($result) {
    $jobs = [];
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
    echo json_encode($jobs);
} else {
    echo json_encode(['error' => 'Error: ' . $conn->error]);
}

$conn->close();
?>