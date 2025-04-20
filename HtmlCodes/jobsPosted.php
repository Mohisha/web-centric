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

// Fetch all job vacancies from the database
$sql = "SELECT Title, Description, Salary, Location, DatePosted FROM jobs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Job Posted</title>
    <link rel="stylesheet" type="text/css" href="css/employerpage.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .job-details {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            border-radius: 10px;
            background-color: #f4f4f4;
        }
        .job-details h2 {
            margin: 0;
        }
        .job-details p {
            margin: 5px 0;
        }
        .jobs-container {
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Job Listings -->
<div class="jobs-container">
    <h1>All Job Postings</h1>

    <?php
    if ($result->num_rows > 0) {
        // Output data for each job
        while ($row = $result->fetch_assoc()) {
            echo '<div class="job-details">';
            echo '<h2>' . htmlspecialchars($row["Title"]) . '</h2>';
            echo '<p><strong>Description:</strong> ' . htmlspecialchars($row['Description']) . '</p>';
            echo '<p><strong>Salary:</strong> $' . number_format($row['Salary'], 2) . '</p>';
            echo '<p><strong>Location:</strong> ' . htmlspecialchars($row['Location']) . '</p>';
            echo '<p><strong>Posted on:</strong> ' . htmlspecialchars($row['DatePosted']) . '</p>';
            echo '</div>';
        }
    } else {
        echo "No jobs found.";
    }
    ?>

    <a href="employerhome.php">Back to Home</a>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
