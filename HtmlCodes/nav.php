<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JobQuest Navbar</title>
    <link rel="stylesheet" href="css/nav.css">
</head>
<body>

<header>
    <div class="wrapper">
        <div class="logo">
            <img src="images/logo1.jpg" alt="JobQuest Logo">
        </div>
        <ul class="nav-area">
            <li>
                <a href="search.php">
                    Job Search
                    <img src="images/search-icon.png" alt="" class="nav-icon" width="22" height="22">
                </a>
            </li>
            <li><a href="jobseeker-home.php">Homepage</a></li>

            <li class="dropdown">
                <a href="profile.php" id="profileNav">Profile</a>

                <ul class="dropdown-menu">
                    <li><a href="applications.php">Applications</a></li>
                </ul>
            </li>


            <li><a href="review.php">Review</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>

</body>
</html>
