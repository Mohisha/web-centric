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
    $name = $_POST['FullName'] ?? '';
    $email = $_POST['Email'] ?? '';
    $phone = $_POST['PhoneNumber'] ?? '';
    $qualifications = $_POST['Qualifications'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $education = $_POST['education'] ?? '';

    $profileData = [
        'FullName' => $name,
        'Email' => $email,
        'PhoneNumber' => $phone,
        'Qualifications' => $qualifications,
        'experience' => $experience,
        'education' => $education,
    ];

    
    // Validate against JSON schema
    $validationErrors = validate_profile_json($profileData);

    if ($validationErrors === true) {
        // Prepare JSON to save in profile coloumn
        $profileJson = json_encode([
            'Qualifications' => $qualifications,
            'experience' => $experience,
            'education' => $education
        ]);

        if (empty($name) || empty($email) || empty($phone)) {
            echo "Error: Missing required fields.";
            var_dump($_POST);  // Dump all the form data for debugging
            exit;  // Stop execution if there's an error
        }

        // Check if profile already exists
        $checkStmt = $conn->prepare("SELECT UserID FROM jobseeker WHERE UserID = ?");
        $checkStmt->bind_param("i", $userID);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        

        if ($result->num_rows > 0) {
            // UPDATE existing profile
            $stmt = $conn->prepare("UPDATE jobseeker 
                SET FullName = ?, Email = ?, PhoneNumber = ?, Profile = ? 
                WHERE UserID = ?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $profileJson, $userID);
        } else {
            // INSERT new profile
            $stmt = $conn->prepare("INSERT INTO jobseeker 
                (UserID, FullName, Email, PhoneNumber, Profile) 
                VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $userID, $name, $email, $phone, $profileJson);
        }

        if ($stmt->execute()) {
            $_SESSION['profile_success'] = "Profile saved successfully!";
            $_SESSION['has_profile'] = true;
            header("Location: profile.php");
            exit;
        } else {
            echo "Database error: " . $stmt->error;
            exit;
        }
    } else {
        // Show validation errors
        echo "<h3>Validation Errors:</h3><ul>";
        foreach ($validationErrors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul><a href='javascript:history.back()'>Go Back</a>";
    }
}
?>
