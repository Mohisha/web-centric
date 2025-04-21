<?php
session_start();
require_once 'database.php';
require_once 'validate_profile_json.php'; // Include the validation function

if (!isset($_SESSION['UserID']) || $_SESSION['role'] !== 'jobseeker') {
    header('Location: login.php');
    exit;
}

$userID = $_SESSION['UserID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form input values
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $qualifications = $_POST['qualifications'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $education = $_POST['education'] ?? '';

    // Collect profile data in an array
    $profileData = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'qualifications' => $qualifications,
        'experience' => $experience,
        'education' => $education,
    ];

    // Validate the profile data using the validate_profile_json function
    $validationErrors = validate_profile_json($profileData);

    if ($validationErrors === true) {
        // Validation passed, proceed with saving to the database
        $profileJson = json_encode([
            'qualifications' => $qualifications,
            'experience' => $experience,
            'education' => $education
        ]);

        // Update the jobseeker record in the database
        $stmt = $conn->prepare("UPDATE jobseeker 
            SET FullName = ?, Email = ?, PhoneNumber = ?, profile = ? 
            WHERE UserID = ?");
        $stmt->bind_param("ssssi", $name, $email, $phone, $profileJson, $userID);
        $stmt->execute();

        // Redirect to the profile page after successful update
        header('Location: profile.php');
        exit;
    } else {
        // Validation failed, display the error messages
        echo "<h3>Validation failed:</h3>";
        echo "<ul>";
        foreach ($validationErrors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        
    }
} else {
    echo "Invalid request.";
}
?>
