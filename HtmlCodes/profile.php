<?php 
session_start();
require_once 'database.php';

// Check if the user is logged in and is a jobseeker
if (!isset($_SESSION['UserID']) || $_SESSION['role'] !== 'jobseeker') {
    header('Location: login.php'); // or show "Access Denied"
    exit;
}

$userID = $_SESSION['UserID'];

// Fetch profile from DB
$stmt = $conn->prepare("SELECT * FROM jobseeker WHERE UserID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Handle if jobseeker record doesn't exist
if (!$row) {
    echo "No profile found. Please contact support.";
    exit;
}

// Extract profile information
$name = $row['FullName'] ?? '';
$DateOfBirth = $row['DateOfBirth'] ?? '';
$phone = $row['PhoneNumber'] ?? '';
$address = $row['Address'] ?? '';
$email = $row['Email'] ?? '';
$profileData = !empty($row['Profile']) ? json_decode($row['Profile'], true) : [];

$qualifications = $profileData['Qualifications'] ?? '';
$experience = $profileData['experience'] ?? '';
$education = $profileData['education'] ?? '';

// Check for success message
$successMessage = $_SESSION['profile_success'] ?? '';
unset($_SESSION['profile_success']);  // Clear the success message after displaying
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
</head>
<body>
<div class="branding-text">JobQuest</div>
<div class="container">
    <div class="profile-header">
        <div class="snapshot-container">
            <div class="profile-snapshot" data-initials="<?= substr($name, 0, 1) ?>">
                <!-- Image will be loaded via JavaScript if available -->
            </div>
            <div class="upload-photo" title="Upload Photo">+</div>
        </div>
        <h2>My Profile <span class="profile-badge">Job Seeker</span></h2>
    </div>

    <!-- Success Message Overlay -->
    <?php if ($successMessage): ?>
        <div id="success-overlay" class="overlay">
            <div class="popup">
                <h2><?= htmlspecialchars($successMessage) ?></h2>
                <button id="close-popup">Close</button>
            </div>
        </div>
    <?php endif; ?>

    <form id="profileForm" class="readonly" method="POST" action="update_profile.php">
        <div class="form-column">
            <div class="field-group">
                <label for="name">Full Name</label>
                <input type="text" id="FullName" name="FullName" value="<?= htmlspecialchars($name) ?>" readonly>
            </div>
            
            <div class="field-group">
                <label for="Email">Email Address</label>
                <input type="email" id="Email" name="Email" value="<?= htmlspecialchars($email) ?>" readonly>
            </div>
        </div>
        
        <div class="form-column">
            <div class="field-group">
                <label for="PhoneNumber">Phone Number</label>
                <input type="text" id="PhoneNumber" name="PhoneNumber" value="<?= htmlspecialchars($phone) ?>" readonly>
            </div>
            
            <div class="field-group">
                <label for="experience">Years of Experience</label>
                <input type="number" id="experience" name="experience" value="<?= htmlspecialchars($experience) ?>" readonly>
            </div>
        </div>
        
        <div class="form-column full-width">
            <div class="field-group">
                <label for="Qualifications">Professional Qualifications</label>
                <textarea id="Qualifications" name="Qualifications" readonly><?= htmlspecialchars($qualifications) ?></textarea>
            </div>
        </div>
        
        <div class="form-column">
            <div class="field-group">
                <label for="education">Education Level</label>
                <select id="education" name="education" disabled>
                    <option value="">Select</option>
                    <option value="High School" <?= $education == "High School" ? "selected" : "" ?>>High School</option>
                    <option value="Bachelor" <?= $education == "Bachelor" ? "selected" : "" ?>>Bachelor's Degree</option>
                    <option value="Master" <?= $education == "Master" ? "selected" : "" ?>>Master's Degree</option>
                    <option value="PhD" <?= $education == "PhD" ? "selected" : "" ?>>PhD</option>
                </select>
            </div>
        </div>
        
        <div class="button-container">
            <button type="button" id="editBtn">Edit Profile</button>
            <button type="submit" id="saveBtn" style="display:none;">Save Changes</button>
        </div>
    </form>
</div>

<script>
    const form = document.getElementById('profileForm');
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    
    editBtn.addEventListener('click', function () {
        form.classList.remove('readonly');
        form.classList.add('editable');
        form.querySelectorAll('input, textarea, select').forEach(el => {
            el.removeAttribute('readonly');
            el.removeAttribute('disabled');
        });
        editBtn.style.display = 'none';
        saveBtn.style.display = 'inline-block';
    });
    
    document.querySelector('.upload-photo').addEventListener('click', function() {
        alert('File upload functionality would be implemented here');
    });
    
    $(document).ready(function () {
        $.getJSON("get_profile_json.php", function (data) {
            if (data.error) {
                alert(data.error);
                return;
            }

            $("#name").val(data.FullName);
            $("#email").val(data.Email);
            $("#phone").val(data.PhoneNumber);
            $("#qualifications").val(data.Qualifications);
            $("#experience").val(data.experience);
            $("#education").val(data.education);

            const firstInitial = data.FullName ? data.FullName.charAt(0) : 'U';
            $(".profile-snapshot").attr('data-initials', firstInitial);
        });
    });

    // Success Message Popup
    const closePopupBtn = document.getElementById('close-popup');
    const overlay = document.getElementById('success-overlay');

    closePopupBtn.addEventListener('click', function () {
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            overlay.style.display = 'none';
        }
    });

    // Show overlay if success message is set
    <?php if ($successMessage): ?>
        $(document).ready(function() {
            $('#success-overlay').fadeIn();
        });
    <?php endif; ?>
</script>

</body>
</html>
