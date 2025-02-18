<?php
session_start();
include 'database.php'; // Ensure this includes your database connection

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the job ID is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    $jobId = $_POST['job_id'];
} else {
    echo "No job selected.";
    exit();
}

// Initialize variables for handling the application
$message = '';
$uploadError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the application form submission
    if (isset($_FILES['resume']) && isset($_FILES['cover_letter']) && isset($_POST['profile'])) {
        $resumeFile = $_FILES['resume'];
        $coverLetterFile = $_FILES['cover_letter'];
        $profile = !empty($_POST['profile']) ? $_POST['profile'] : null;// Check if profile is set and assign null if empty

        // Validate and upload resume
        if ($resumeFile['error'] === UPLOAD_ERR_OK) {
            $resumeFilePath = 'uploads/resumes/' . basename($resumeFile['name']);
            move_uploaded_file($resumeFile['tmp_name'], $resumeFilePath);
        } else {
            $uploadError = "Failed to upload resume. Please try again.";
        }

        // Validate and upload cover letter
        if ($coverLetterFile['error'] === UPLOAD_ERR_OK) {
            $coverLetterFilePath = 'uploads/cover_letters/' . basename($coverLetterFile['name']);
            move_uploaded_file($coverLetterFile['tmp_name'], $coverLetterFilePath);
        } else {
            $uploadError = "Failed to upload cover letter. Please try again.";
        }

        // Prepare to insert application data into the database
        if (empty($uploadError)) {
            $jobSeekerId = $_SESSION['username']; // Assuming username is used as JobSeekerID
            $stmt = $conn->prepare("INSERT INTO application (JobID, JobSeekerID, ResumeFilePath, DateApplied, Status, CoverLetter, Profile) VALUES (?, ?, ?, NOW(),  'pending', ?, ?)");
            $stmt->bind_param("sssss", $jobId, $jobSeekerId, $resumeFilePath, $coverLetterFilePath, $profile);

            if ($stmt->execute()) {
                $message = "Application submitted successfully!";
            } else {
                $message = "Error submitting application. Please try again.";
            }

            $stmt->close();
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Job</title>
    <link rel="stylesheet" href="css/jobdetail.css">
</head>
<body>
    <header>
        <h1>Apply for Job</h1>
        <?php if (!empty($message)) : ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <?php if (!empty($uploadError)) : ?>
            <p><?php echo htmlspecialchars($uploadError); ?></p>
        <?php endif; ?>
    </header>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($jobId); ?>">
        
        <label for="resume">Upload Resume:</label>
        <input type="file" name="resume" id="resume" required>

        <label for="cover_letter">Upload Cover Letter:</label>
        <input type="file" name="cover_letter" id="cover_letter" required>

        <label for="profile">Profile (optional but recommended):</label>
        <textarea name="profile" id="profile" rows="4" placeholder="Write a few things about yourself..."></textarea>

        <button type="submit" class="apply-btn">Submit Application</button>
    </form>

    <!-- Back to Job Detail -->
    <a href="job-detail.php" class="back-btn">Back to Job Detail</a>
</body>
</html>
