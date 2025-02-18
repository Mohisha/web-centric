<?php
session_start();
include 'database.php'; 

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve the username from the session
$username = $_SESSION['username'];

// Fetch job recommendations from the database
$jobQuery = "SELECT JobID, Title, Description, DatePosted FROM jobs ORDER BY DatePosted DESC";
$jobResult = $conn->query($jobQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="css/jobseeker.css">
</head>
<body>
  
<header>
    <div class="wrapper">
        <div class="logo">
            <img src='images/logo1.png' alt='JobQuest Logo'>
        </div>
        <ul class="nav-area">
            <li><a href="jobseeker-home.php">Homepage</a></li>
            <li><a href="search.php">Job Search</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="review.php">Review</a></li>
            <li><a href="logout.php">Logout</a></li>
            <!-- Search Form -->
        </ul>
    </div>
</header>

<div class="welcome-text">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>

    <h2>Job Recommendations</h2>
    <ul class="job-list"> <!-- Add a class to the list for styling -->
        <?php
        if ($jobResult->num_rows > 0) {
            while ($job = $jobResult->fetch_assoc()) {
                echo "<li>";
                // Form submission for job details using POST
                echo "<form action='job-detail.php' method='POST'>";
                echo "<input type='hidden' name='job_id' value='" . $job['JobID'] . "'>";
                echo "<button type='submit' class='job-title'>" . htmlspecialchars($job['Title']) . "</button>";
                echo "</form>";
                echo "<p class='job-description'>" . htmlspecialchars($job['Description']) . "</p>";
                echo "<small>Posted on: " . htmlspecialchars($job['DatePosted']) . "</small>";
                echo "</li>";
            }
        } else {
            echo "<li>No job recommendations available at the moment.</li>";
        }
        ?>
    </ul>
</div>

<?php $conn->close(); ?>
</body>
</html>
