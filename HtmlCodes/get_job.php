<?php 
// get_job.php - Fetches a single job by JobID
include 'database.php'; 

// Set response header to JSON
header('Content-Type: application/json');

// Check database connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get JobID from request
$jobId = isset($_GET['id']) ? trim($_GET['id']) : '';

if (empty($jobId)) {
    echo json_encode(['error' => 'Invalid Job ID']);
    $conn->close();
    exit;
}

// Prepare and execute the SQL query
$sql = "SELECT * FROM jobs WHERE JobID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $jobId);
$stmt->execute();
$result = $stmt->get_result();

// Return job if found
if ($result && $result->num_rows > 0) {
    $job = $result->fetch_assoc();
    echo json_encode($job);
} else {
    echo json_encode(['error' => 'Job not found']);
}

// Clean up
$stmt->close();
$conn->close();
?>
