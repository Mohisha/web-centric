<?php
session_start();
require_once 'database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['UserID'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userID = $_SESSION['UserID'];

$stmt = $conn->prepare("SELECT FullName, Email, PhoneNumber, profile FROM jobseeker WHERE UserID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo json_encode(['error' => 'No profile found']);
    exit;
}

$profileData = json_decode($data['profile'], true) ?? [];
$data['qualifications'] = $profileData['qualifications'] ?? '';
$data['experience'] = $profileData['experience'] ?? '';
$data['education'] = $profileData['education'] ?? '';
unset($data['profile']);

echo json_encode($data);
?>