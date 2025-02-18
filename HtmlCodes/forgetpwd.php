<!Doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Forget Password</title>
    <style>
        body {
            width: 80%;
            margin-right: 90%;
            background-image:url("C:\xampp\htdocs\HtmlCodes\css\images\forgetpsd.jpg");
            height: 80vh;
            background-size:70% 150%;
            background-position: right;
            background-repeat: no-repeat;
            position: relative;
        }
        .forget {
            display: inline-block;
            color: rgb(49, 48, 48);
            width: 50%;
            padding-left: 10px;
            margin: 5px 0;
            text-align: center;
            border:  2px solid #000000;
            margin-left: 0%;
            margin-top: 150px;
        }
    </style>
  </head>
  <body>

    <div class="forget">
        <h1>Forgot your password?</h1>
        <p>Please provide your email address. You will receive an email to create a new password.</p>

        <form action="" method="POST">
            <input type="email" placeholder="Email Address" name="email" required>
            <button type="submit">Enter</button>
        </form>

        <p><a href="login.php">Back to Login</a></p> <!-- Changed to login.php -->
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];

            // Validate email format
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<p style='text-align:center;color:green;'>Password reset instructions have been sent to $email.</p>";
                // Here, you would normally send an email with the reset link
            } else {
                echo "<p style='text-align:center;color:red;'>Invalid email address. Please try again.</p>";
            }
        }
    ?>
  </body>
</html>
