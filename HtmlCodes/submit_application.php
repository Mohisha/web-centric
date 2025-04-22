<?php
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['UserID'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

require_once __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobID = $_POST['jobID'] ?? '';
    $jobseekerID = $_POST['jobseekerID'] ?? '';
    $coverLetter = $_POST['coverLetter'] ?? '';
    $cvFile = $_FILES['cv'] ?? null;

    // Check for missing fields
    if (!$jobID || !$jobseekerID || !$coverLetter || !$cvFile) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    // Upload CV
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $cvName = basename($cvFile['name']);
    $targetPath = $uploadDir . uniqid() . '_' . $cvName;
    if (!move_uploaded_file($cvFile['tmp_name'], $targetPath)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload CV']);
        exit;
    }
    $relativePath = 'uploads/' . basename($targetPath);

    // Build data object
    $data = [
        "jobseekerID" => (int)$jobseekerID,
        "jobID" => $jobID,
        "coverLetter" => $coverLetter,
        "resumeFilePath" => $relativePath,
        "dateApplied" => date("Y-m-d"),
        "status" => 'Pending'  // Default status
    ];

    // Generate Application ID
    function generateApplicationID($conn) {
        $result = $conn->query("SELECT ApplicationID FROM application ORDER BY ApplicationID DESC LIMIT 1");
        if ($row = $result->fetch_assoc()) {
            $lastID = (int)substr($row['ApplicationID'], 1);
            return 'A' . str_pad($lastID + 1, 4, '0', STR_PAD_LEFT);
        } else {
            return 'A0001';
        }
    }

    $applicationID = generateApplicationID($conn);

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO application (ApplicationID, JobID, JobSeekerID, ResumeFilePath, DateApplied, Status, CoverLetter) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $applicationID, $data['jobID'], $data['jobseekerID'], $data['resumeFilePath'], $data['dateApplied'], $data['status'], $data['coverLetter']);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Application submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $stmt->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
