<?php
session_start();
include 'database.php'; 

if (!isset($_SESSION['username'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Check if search query is set
$searchResults = [];
if (isset($_GET['query'])) {
    $searchQuery = $conn->real_escape_string($_GET['query']);

    // Search jobs in the database
    $sql = "SELECT * FROM jobs WHERE Title LIKE '%$searchQuery%' OR Description LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row; // Store results in an array
        }
    } else {
        $message = "No jobs found matching your search.";
    }
} else {
    $message = "No search query provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to right, #7a44b361, #5b7bb26d); ;
        }

        header {
            color: black;
            padding: 10px 0;
            text-align: center;
        }

        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container input[type="text"] {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-container input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .job-list {
            list-style-type: none;
            padding: 0;
        }

        .job-list li {
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 15px;
        }

        .job-list a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .job-list a:hover {
            text-decoration: underline;
        }

        .job-location, .job-date {
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    <h1>Job Search</h1>
</header>

<div class="search-container">
    <form action="" method="GET">
        <input type="text" name="query" placeholder="Search for jobs..." required>
        <input type="submit" value="Search">
    </form>
</div>

<div class="results-container">
    <?php if (!empty($searchResults)): ?>
        <h2>Search Results for: <?php echo htmlspecialchars($_GET['query']); ?></h2>
        <ul class="job-list">
            <?php foreach ($searchResults as $job): ?>
                <li>
                    <a href="applyjob.php?jobID=<?php echo $job['JobID']; ?>"><?php echo htmlspecialchars($job['Title']); ?></a>
                    <p><?php echo htmlspecialchars($job['Description']); ?></p>
                    <span class="job-location">Location: <?php echo htmlspecialchars($job['Location']); ?></span>
                    <span class="job-date"> | Date Posted: <?php echo htmlspecialchars($job['DatePosted']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
