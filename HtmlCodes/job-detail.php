<?php
session_start();
include 'database.php'; 

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the job ID is passed via GET or if it's in the session
if (isset($_GET['job_id'])) {
    $_SESSION['job_id'] = $_GET['job_id'];
} elseif (!isset($_SESSION['job_id'])) {
    // If no job is selected, show a message and exit
    echo "No job selected. Please go back to the <a href='jobseeker-home.php'>job listings</a>.";
    exit();
}

// Use the job ID stored in the session to fetch job details
$jobId = $_SESSION['job_id'];

// Fetch job details from the database
$jobQuery = "SELECT j.Title, j.Description, j.Location, j.Salary, j.DatePosted, j.JobType, j.JobCategory, j.YearsOfExperience, e.CompanyName 
             FROM jobs j 
             JOIN employer e ON j.EmpID = e.EmployerID 
             WHERE j.JobID = ?";
$data = $conn->prepare($jobQuery);
$data->bind_param("s", $jobId);
$data->execute();
$result = $data->get_result();

// If the job is not found, show a friendly message and exit
if ($result->num_rows === 0) {
    echo "Job not found. Please go back to the <a href='jobseeker-home.php'>job listings</a>.";
    exit();
}

$job = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['Title']); ?></title>
    <link rel="stylesheet" href="css/jobdetail.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars($job['Title']); ?></h1>
        <p><?php echo htmlspecialchars($job['Description']); ?></p>
        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['Location']); ?></p>
        <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['Salary']); ?></p>
        <p><strong>Posted on:</strong> <?php echo htmlspecialchars($job['DatePosted']); ?></p>
        <p><strong>Employment Type:</strong> <?php echo htmlspecialchars($job['JobType']); ?></p>
        <p><strong>Job Field:</strong> <?php echo htmlspecialchars($job['JobCategory']); ?></p>
        <p><strong>Years Of Experience:</strong> <?php echo htmlspecialchars($job['YearsOfExperience']); ?></p>
        <p><strong>Company Name:</strong> <?php echo htmlspecialchars($job['CompanyName']); ?></p>
    </header>

    <!-- Back to Job List -->
    <a href="jobseeker-home.php" class="back-btn">Back</a>

    <a href="applyjob.php?jobID=<?php echo urlencode($jobId); ?>" class="apply-btn">Apply for Job</a>

</body>
</html>

<?php $conn->close(); ?>
