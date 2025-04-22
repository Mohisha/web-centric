<?php
header('Content-Type: application/json');
include 'database.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['ids']) && is_array($data['ids'])) {
    $ids = $data['ids'];
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $stmt = mysqli_prepare($conn, "DELETE FROM employer WHERE EmployerID IN ($placeholders)");
    $types = str_repeat('i', count($ids));
    mysqli_stmt_bind_param($stmt, $types, ...$ids);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No IDs provided']);
}

mysqli_close($conn);
?>
