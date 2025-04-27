<?php
session_start();
include 'database.php'; 

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

if (isset($_GET['job_id'])) {
    $_SESSION['job_id'] = $_GET['job_id'];
} elseif (!isset($_SESSION['job_id'])) {
    echo "No job selected.";
    exit();
}


// Use the job ID stored in the session to fetch job details
$jobId = $_SESSION['job_id'];


$jobQuery = "SELECT j.Title, j.Description, j.Location, j.Salary, j.DatePosted, j.JobType, j.JobCategory, j.YearsOfExperience, e.CompanyName FROM jobs j JOIN employer e ON j.EmpID = e.EmployerID WHERE j.JobID = ?";
$data = $conn->prepare($jobQuery);
$data->bind_param("s", $jobId);
$data->execute();
$result = $data->get_result();

if ($result->num_rows === 0) {
    echo "Job not found.";
    exit();
}

$job = $result->fetch_assoc();

$back_url = "jobseeker-home.php"; // default
if (isset($_COOKIE['source'])) {
    $source = $_COOKIE['source'];
}
if($source == 'home'){
    $back_url = "jobseeker-home.php";
}
if($source == 'job_detail'){
    $back_url = "search.php";
}

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
        <p><strong>Job Field:</strong> <?php echo htmlspecialchars($job['JobCategory']); ?> </p>
        <p><strong>Years Of Experience:</strong> <?php echo htmlspecialchars($job['YearsOfExperience']); ?> </p>
        <p><strong>Company Name:</strong> <?php echo htmlspecialchars($job['CompanyName']); ?></p>

    </header>
   
    <!-- Back to Job List -->
    <a href=<?php echo $back_url; ?> class="back-btn">Back</a>

    <a href="applyjob.php?jobID=<?php echo urlencode($jobId); ?>" class="apply-btn">Apply for Job</a>

</body>
</html>
<?php $conn->close(); ?>
