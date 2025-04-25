<?php
header('Content-Type: application/json');
include 'database.php'; 

$sql = "SELECT * FROM jobseeker";
$result = mysqli_query($conn, $sql);

$jobseekers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $jobseekers[] = $row;
}

echo json_encode(['status' => 'success', 'data' => $jobseekers]);
?>
