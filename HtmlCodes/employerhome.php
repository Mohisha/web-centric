<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobrecruitment";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch job vacancies from the database
$sql = "SELECT Title, DatePosted FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Your Recruitment Platform</title>
    <link rel="stylesheet" type="text/css" href="css/employerpage.css?v=1.1">
    
</head>
<body>

<!-- Navbar -->
<nav>
    <ul>
        <li><a href="employerhome.php">Home</a></li>
        <li><a href="jobsPosted.php">Jobs Posted</a></li>
        <li><a href="profile.php">Profile</a></li>
    </ul>
    <div class="login-icon">
    <a href="registercompany.php">👤</a>    </div>
</nav>

<!-- Job Listings -->
<div class="jobs-container">
    <h1>Job Vacancies</h1>

    <?php
    if ($result->num_rows > 0) {
        // Output data for each row
        while($row = $result->fetch_assoc()) {
            echo '<div class="job-block">';
            echo '<h2>' . htmlspecialchars($row["Title"]) . '</h2>';
            echo '<p>Posted on: ' . htmlspecialchars($row["DatePosted"]) . '</p>';
            echo '<p><a href="jobdetails.php?Title=' . urlencode($row["Title"]) . '">View Details</a></p>'; // Passing job title in the URL
            echo '</div>';
        }
    } else {
        echo "No jobs found.";
    }
    ?>

</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
