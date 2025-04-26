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
$userID = $_SESSION['UserID'];

// Check if the user has a profile
$profileCheck = $conn->prepare("SELECT UserID FROM jobseeker WHERE UserID = ?");
$profileCheck->bind_param("i", $userID);
$profileCheck->execute();
$profileResult = $profileCheck->get_result();
$showProfilePopup = ($profileResult->num_rows === 0); // User has no profile

// Fetch job recommendations from the database
$jobQuery = "SELECT JobID, Title, Description, DatePosted FROM jobs ORDER BY DatePosted DESC";
$jobResult = $conn->query($jobQuery);

setcookie('source', 'home');
unset($_SESSION['has_profile']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Seeker Dashboard</title>
    <link rel="stylesheet" href="css/jobseeker.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body style="background-image: url('https://cdn.sanity.io/images/uqxwe2qj/production/4ee9fb18bdc214aefebf7859557a6611125c3841-760x426.png?q=80&auto=format&fit=clip&w=760');">

<?php 
    include("nav.php");
?>

<div class="welcome-text">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>

    <h2>Job Recommendations</h2>
    <div class="job-list">
        <?php
        if ($jobResult->num_rows > 0) {
            while ($job = $jobResult->fetch_assoc()) {
                echo "<div class= 'job-card'>";
                echo "<p class='job-title'>" . htmlspecialchars($job['Title']) . "</p>";
                echo "<p class='job-description'>" . htmlspecialchars($job['Description']) . "</p>";
                echo "<p class='job-date'>" . htmlspecialchars($job['DatePosted']) . "</p>";
                echo "<a href='job-detail.php?job_id=" . urlencode($job['JobID']) . "' class='view-more-btn'>View More</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No jobs found at the moment.</p>";
        }
        ?>
    </div>
</div>

<div id="createProfilePopup" class="popup-overlay" style="display:none;">
    <div class="popup-content">
        <button class="close-btn" title="Close">&times;</button>
        <h2>Create Your Profile</h2>
        <p>Welcome! To continue, please complete your job seeker profile.</p>
        <button id="goToCreateProfile">Create Profile</button>
    </div>
</div>

<style>
.popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.popup-content {
    background: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    position: relative;
    width: 300px;
}
.popup-content h2 {
    margin-top: 0;
}
.popup-content button {
    padding: 10px 20px;
    font-size: 16px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.popup-content button:hover {
    background: #0056b3;
}
.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
}
</style>


<script>
$(document).ready(function() {
    const hasProfile = <?= $showProfilePopup ? 'false' : 'true' ?>;

    // Override Profile nav link if user has no profile
    $('#profileNav').on('click', function(e) {
        if (!hasProfile) {
            e.preventDefault();
            $('#createProfilePopup').fadeIn();
        } else {
            window.location.href = 'profile.php';
        }
    });

    $('#goToCreateProfile').on('click', function() {
        window.location.href = 'create_profile.php';
    });

    $('.close-btn').on('click', function() {
        $('#createProfilePopup').fadeOut();
    });
});

</body>
</html>


