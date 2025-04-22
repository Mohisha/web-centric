<?php
session_start();
require_once 'database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['UserID'])) {
    echo json_encode(["error" => "User not logged in."]);
    exit();
}

$jobseekerID = $_SESSION['UserID'];

$query = "
    SELECT a.ApplicationID, a.DateApplied, a.Status, a.CoverLetter, a.ResumeFilePath, 
           j.JobID, j.Title AS Title, j.Description AS Description, 
           j.Location, j.Salary, j.DatePosted, j.JobType, j.JobCategory, j.YearsOfExperience
    FROM application a
    JOIN jobs j ON a.JobID = j.JobID
    WHERE a.JobseekerID = ?
";

$stmt = $conn->prepare($query);
if ($stmt === false) {
    echo json_encode(["error" => "Prepare failed: " . $conn->error]);
    exit();
}

$stmt->bind_param('i', $jobseekerID);
if (!$stmt->execute()) {
    echo json_encode(["error" => "Execute failed: " . $stmt->error]);
    exit();
}

$result = $stmt->get_result();
if ($result === false) {
    echo json_encode(["error" => "Result fetch failed: " . $stmt->error]);
    exit();
}

$applications = [];
while ($row = $result->fetch_assoc()) {
    $applications[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($applications);
?>
