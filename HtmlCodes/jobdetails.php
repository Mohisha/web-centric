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

// Get the job title from the query string, ensuring it's properly sanitized
$JobTitle = isset($_GET['Title']) ? urldecode($_GET['Title']) : '';

// Fetch job details for the specific job title from the database
$sql = "SELECT Title, Description, Salary, Location, DatePosted FROM jobs WHERE Title = ?";
$stmt = $conn->prepare($sql);

// Check if prepare() statement was successful
if ($stmt === false) {
    die("Error in SQL: " . $conn->error);
}

// Bind parameters and execute the statement
$stmt->bind_param("s", $JobTitle);
$stmt->execute();
$result = $stmt->get_result();

// Check if a job was found
if ($result->num_rows > 0) {
    $job = $result->fetch_assoc(); // Store the job data in the $job variable
} else {
    echo "Job not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link rel="stylesheet" type="text/css" href="css/employerpage.css">
    <style>
        body {
            font-family: Arial, sans-serif;
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
    </style>
</head>
<body>

<div class="job-details">
    <h2><?php echo htmlspecialchars($job['Title']); ?></h2>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($job['Description']); ?></p>
    <p><strong>Salary:</strong> $<?php echo number_format($job['Salary'], 2); ?></p>
    <p><strong>Location:</strong> <?php echo htmlspecialchars($job['Location']); ?></p>
    <p><strong>Posted on:</strong> <?php echo htmlspecialchars($job['DatePosted']); ?></p>
</div>

<a href="employerhome.php" style="font-size: 18px; color: white;">Back to Home</a>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
