<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

header("Location: login.php"); // Change 'login.php' to your actual login page URL
exit();
?>