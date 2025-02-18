<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Log out the user
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = [];
    
    // Destroy the session
    session_destroy();
    
    // Redirect to login page or homepage
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="css/logout.css"> <!-- Optional CSS for styling -->
</head>
<body>

<h1>Logout</h1>
<p>Are you sure you want to log out?</p>

<form action="logout.php" method="POST">
    <button type="submit" name="logout" class="logout-btn">Logout</button>
</form>

<a href="jobseeker-home.php" class="back-btn">Cancel</a>

</body>
</html>
