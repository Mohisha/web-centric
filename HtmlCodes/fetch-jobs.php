<?php
include 'database.php';

$searchTitle = $_POST['search_title'] ?? '';
$searchCategory = $_POST['search_category'] ?? '';
$searchType = $_POST['search_type'] ?? '';

$sql = "SELECT JobID, Title, Location, Salary, DatePosted, JobType, JobCategory FROM jobs WHERE 1=1";
$params = [];
$types = '';

if (!empty($searchTitle)) {
    $sql .= " AND Title LIKE ?";
    $params[] = "%" . $searchTitle . "%";
    $types .= 's';
}

if (!empty($searchCategory)) {
    $sql .= " AND JobCategory = ?";
    $params[] = $searchCategory;
    $types .= 's';
}

if (!empty($searchType)) {
    $sql .= " AND JobType = ?";
    $params[] = $searchType;
    $types .= 's';
}


$stmt = $conn->prepare($sql);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($job = $result->fetch_assoc()) {
        echo "<li>";
        echo "<strong>" . htmlspecialchars($job['Title']) . "</strong><br>";
        echo "<small>" . htmlspecialchars($job['Location']) . " | " . htmlspecialchars($job['JobType']) . " | " . htmlspecialchars($job['Salary']) . "</small><br>";
        echo "<a class=\"job-detail\" href=\"job-detail.php?job_id=" . $job['JobID'] . "\">View Details</a>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No jobs found matching your criteria.</p>";
}

$conn->close();
