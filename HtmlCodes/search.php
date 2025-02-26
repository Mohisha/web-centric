<?php
session_start();
include 'database.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Define the search criteria variables
$searchTitle = isset($_POST['search_title']) ? $_POST['search_title'] : '';
$searchType = isset($_POST['search_type']) ? $_POST['search_type'] : '';
$searchCategory = isset($_POST['search_category']) ? $_POST['search_category'] : '';

// Create the SQL query with optional filters
$sql = "SELECT JobID, Title, Location, Salary, DatePosted, JobType, JobCategory FROM jobs WHERE 1=1";

// Apply filters if the user has provided them
if (!empty($searchTitle)) {
    $sql .= " AND Title LIKE ?";
}
if (!empty($searchType)) {
    $sql .= " AND JobType = ?";
}
if (!empty($searchCategory)) {
    $sql .= " AND JobCategory = ?";
}

// Prepare the query
$stmt = $conn->prepare($sql);

// Bind the parameters based on the user's input
$params = [];
$types = '';

if (!empty($searchTitle)) {
    $params[] = "%" . $searchTitle . "%";
    $types .= 's'; // string
}
if (!empty($searchType)) {
    $params[] = $searchType;
    $types .= 's'; // string
}
if (!empty($searchCategory)) {
    $params[] = $searchCategory;
    $types .= 's'; // string
}

// Bind the parameters to the statement and execute
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <style>
        /* Add your existing CSS styles here */
    </style>
</head>
<body>

<header>
    <h1>Search for Jobs</h1>
</header>

<main class="container">
    <form action="search.php" method="POST">
        <div class="search-boxes">
            <div class="search-box">
                <label for="search_title">Job Title</label>
                <input type="text" name="search_title" id="search_title" value="<?php echo htmlspecialchars($searchTitle); ?>" placeholder="Search for a job title">
            </div>

            <div class="search-box">
                <label for="search_category">Job Category</label>
                <select name="search_category" id="search_category">
                    <option value="">Select Category</option>
                    <option value="IT" <?php echo ($searchCategory == 'IT') ? 'selected' : ''; ?>>IT</option>
                    <option value="Healthcare" <?php echo ($searchCategory == 'Healthcare') ? 'selected' : ''; ?>>Healthcare</option>
                    <option value="Finance" <?php echo ($searchCategory == 'Finance') ? 'selected' : ''; ?>>Finance</option>
                    <!-- Add more categories as needed -->
                </select>
            </div>

            <div class="search-box">
                <label for="search_type">Job Type</label>
                <select name="search_type" id="search_type">
                    <option value="">Select Job Type</option>
                    <option value="Full-time" <?php echo ($searchType == 'Full-time') ? 'selected' : ''; ?>>Full-time</option>
                    <option value="Part-time" <?php echo ($searchType == 'Part-time') ? 'selected' : ''; ?>>Part-time</option>
                    <!-- Add more job types as needed -->
                </select>
            </div>
        </div>

        <button type="submit">Search</button>
    </form>

    <!-- Displaying job results only if the form has been submitted and results are found -->
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $result->num_rows > 0): ?>
        <div class="job-results">
            <h2>Job Listings</h2>
            <ul>
                <?php while ($job = $result->fetch_assoc()): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($job['Title']); ?></strong><br>
                        <small><?php echo htmlspecialchars($job['Location']); ?> | <?php echo htmlspecialchars($job['JobType']); ?> | <?php echo htmlspecialchars($job['Salary']); ?></small><br>
                        <a href="job-detail.php?job_id=<?php echo htmlspecialchars($job['JobID']); ?>" class="back-btn">View Details</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="no-results">
            No jobs found with the specified criteria.
        </div>
    <?php endif; ?>

    <!-- Back Button to retain search criteria -->
    <a href="search.php" class="back-btn">Back to Search</a>

</main>

<footer>
    <p>&copy; 2025 JobQuest. All Rights Reserved.</p>
</footer>

</body>
</html>

<?php $conn->close(); ?>
