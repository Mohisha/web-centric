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
<body style="background-image: url('https://cdn.sanity.io/images/uqxwe2qj/production/4ee9fb18bdc214aefebf7859557a6611125c3841-760x426.png?q=80&auto=format&fit=clip&w=760');">

<header>
    <div class="wrapper">
        <div class="logo">
            <img src='images/logo1.jpg' alt='JobQuest Logo'>
        </div>
        <ul class="nav-area">
            <li>
                <a href="search.php">Job Search<img src="images/search-icon.png" alt="" class="nav-icon" width="22" height="22"></a>
            </li>
            <li><a href="jobseeker-home.php">Homepage</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="review.php">Review</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>

<div class="welcome-text">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>

    <h2>Job Recommendations</h2>
    <ul class="job-list">
        <?php
        if ($jobResult->num_rows > 0) {
            while ($job = $jobResult->fetch_assoc()) {
                echo "<li>";
                echo "<form action='job-detail.php' method='POST'>";
                echo "<input type='hidden' name='job_id' value='" . $job['JobID'] . "'>";
                echo "<button type='submit' class='job-title'>" . htmlspecialchars($job['Title']) . "</button>";
                echo "</form>";
                echo "<p class='job-description'>" . htmlspecialchars($job['Description']) . "</p>";
                echo "<p class='job-date'>" . htmlspecialchars($job['DatePosted']) . "</p>";
                echo "</li>";
            }
        } else {
            echo "<p>No jobs found at the moment.</p>";
        }
        ?>
    </ul>
</div>

</body>
</html>
