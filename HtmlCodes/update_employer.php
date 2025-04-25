<?php
header('Content-Type: application/json');
include 'database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['EmployerID'])) {
    $id = $data['EmployerID'];
    $companyName = $data['CompanyName'];
    $description = $data['Description'];
    $startDate = $data['StartDate'];
    $address = $data['Address'];
    $phone = $data['ContactNumber'];
    $email = $data['Email'];
    $website = $data['Website'];

    $sql = "UPDATE employer 
            SET CompanyName = ?, Description = ?, StartDate = ?, Address = ?, ContactNumber = ?, Email = ?, Website = ?
            WHERE EmployerID = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $companyName, $description, $startDate, $address, $phone, $email, $website, $id);

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
