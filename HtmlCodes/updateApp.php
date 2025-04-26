<?php
include 'database.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $applicationId = mysqli_real_escape_string($conn, $_POST['ApplicationID'] ?? '');
    $jobId = mysqli_real_escape_string($conn, $_POST['JobID'] ?? '');
    $jobSeekerId = mysqli_real_escape_string($conn, $_POST['JobSeekerID'] ?? '');
    $resumeFilePath = mysqli_real_escape_string($conn, $_POST['ResumeFilePath'] ?? '');
    $dateApplied = mysqli_real_escape_string($conn, $_POST['DateApplied'] ?? '');
    $status = mysqli_real_escape_string($conn, $_POST['Status'] ?? '');
    $coverLetter = mysqli_real_escape_string($conn, $_POST['CoverLetter'] ?? '');

    if (empty($applicationId)) {
        echo json_encode(['success' => false, 'message' => 'ApplicationID is missing!']);
        exit;
    }

    // Check if JobID is provided
    if (empty($jobId)) {
        echo json_encode(['success' => false, 'message' => 'JobID is missing!']);
        exit;
    }

    // Check if JobID exists in the jobs table
    $checkJobQuery = "SELECT JobID FROM jobs WHERE JobID = '$jobId'";
    $result = mysqli_query($conn, $checkJobQuery);

    if (mysqli_num_rows($result) === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid JobID. Job does not exist.']);
        exit;
    }

    // Update SQL query
    $sql = "UPDATE application 
            SET JobID = '$jobId', 
                JobSeekerID = '$jobSeekerId', 
                ResumeFilePath = '$resumeFilePath', 
                DateApplied = '$dateApplied', 
                Status = '$status', 
                CoverLetter = '$coverLetter' 
            WHERE ApplicationID = '$applicationId'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Application updated successfully.']);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to update application.', 
            'error' => mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
