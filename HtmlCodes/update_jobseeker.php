<?php
header('Content-Type: application/json');
include 'database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['JobSeekerID'])) {
    $id = $data['JobSeekerID'];
    $fullName = $data['FullName'];
    $dateOfBirth = $data['DateOfBirth'];
    $phoneNumber = $data['PhoneNumber'];
    $gender = $data['Gender'];
    $address = $data['Address'];
    $profile = $data['Profile'];
    $email = $data['Email'];

    $sql = "UPDATE jobseeker 
            SET FullName = ?, DateOfBirth = ?, PhoneNumber = ?, Gender = ?, Address = ?, Profile = ?, Email = ? 
            WHERE JobSeekerID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $fullName, $dateOfBirth, $phoneNumber, $gender, $address, $profile, $email, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
}

mysqli_close($conn);
?>
