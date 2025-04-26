<?php
session_start();
include 'database.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT UserID, UserName, Password, Role FROM user WHERE UserName= '$username'";

    $result = $conn->query($sql) ;
       
    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
       
        $match = password_verify($password, $user['Password']);
        if ($match) {
            // Store username and role in session
            $_SESSION['username'] = $user['UserName'];
            $_SESSION['role'] = strtolower($user['Role']);
            $_SESSION['UserID'] = $user['UserID'];  // Make sure you have the user 'id' in the database
            
            session_regenerate_id(true); // Secure and refresh the session

            // Redirect based on user role
            if ($user['Role'] == "jobseeker") {
                header("Location: jobseeker-home.php");
            } else if ($user['Role'] == "employer") {
                header("Location: employerhome.php");
            } else if ($user['Role'] == "admin") {
                header("Location: admin-home.php");
            }else {
                // Redirect to a default page if the role is unrecognized
                header("Location: home.php");
            }
            exit(); // Make sure to call exit after a redirect
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No user found!";
    }

}
$conn->close(); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Credentials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url("https://thumbs.dreamstime.com/b/home-office-background-webinar-zoom-meeting-virtual-presentation-346023532.jpg");
            background-size: cover;
            background-position:center;
        }
        .login {
            padding: 50px;
            border-radius: 30px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }
        button {
            width: 150px;
            padding: 10px;
            margin-top:20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        .forgot-password a {
            text-decoration: none;
            color: #fa0945;
            font-size: 12px;
            font-weight: bold;
        }
        .error {
            color: red;
            font-size: 16px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
            <button type="submit">Login</button>
            <div class="forgot-password">
                <p><a href="forgetpwd.html">Forgot Password?</a></p>
            </div>
            <?php if (isset($error_message)): ?>
                <p style="color:red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
