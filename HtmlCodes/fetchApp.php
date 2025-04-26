<?php
include 'database.php';

$sql = "SELECT a.*, j.Title as JobTitle, js.FullName 
        FROM application a 
        JOIN jobs j ON a.JobID = j.JobID 
        JOIN jobseeker js ON a.JobSeekerID = js.JobSeekerID";

$result = mysqli_query($conn, $sql);

$applications = [];

while ($row = mysqli_fetch_assoc($result)) {
    $applications[] = $row;
}

echo json_encode($applications);
?>
