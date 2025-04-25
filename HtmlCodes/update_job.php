<?php
include 'database.php';

if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Get job data from request
$jobId = $_POST['JobID'];
$empId = $_POST['EmpID'];
$title = $_POST['Title'];
$description = $_POST['Description'];
$location = $_POST['Location'];
$salary = $_POST['Salary'];
$jobType = $_POST['JobType'];
$jobCategory = $_POST['JobCategory'];
$yearsOfExperience = $_POST['YearsOfExperience'];

// Use prepared statement with placeholder for JobID
$sql = "UPDATE jobs SET EmpID = ?, Title = ?, Description = ?, 
        Location = ?, Salary = ?, JobType = ?, 
        JobCategory = ?, YearsOfExperience = ?
        WHERE JobID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssis", 
    $empId, 
    $title, 
    $description, 
    $location, 
    $salary, 
    $jobType, 
    $jobCategory, 
    $yearsOfExperience,
    $jobId // Now safely bound
);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'jobId' => $sql]);
} else {
    echo json_encode(['error' => 'Error updating job: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
