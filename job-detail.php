<?php
session_start();
include 'database.php'; 

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if the job_id is sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['job_id'])) {
    // Store the job ID in a session variable
    $_SESSION['job_id'] = $_POST['job_id'];
} elseif (!isset($_SESSION['job_id'])) {
    echo "No job selected.";
    exit();
}

// Use the job ID stored in the session to fetch job details
$jobId = $_SESSION['job_id'];

// Fetch job details from the database
$jobQuery = "SELECT Title, Description, Location, Salary, DatePosted FROM jobs WHERE JobID = ?";
$data = $conn->prepare($jobQuery);
$data->bind_param("s", $jobId); 
$data->execute();
$result = $data->get_result();

if ($result->num_rows === 0) {
    echo "Job not found.";
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
    </header>

    <!-- Back to Job List -->
    <a href="jobseeker-home.php" class="back-btn">Back to Job List</a>

    <!-- Apply for Job Button -->
    <form action="applyjob.php" method="POST">
    <input type="hidden" name="job_id" value="<?php echo $jobId; ?>">
    <button type="submit" class="apply-btn">Apply for Job</button>
</form>
</body>
</html>
<?php $conn->close(); ?>
