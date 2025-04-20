<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
setcookie("source", "job_detail");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Search</title>
    <link rel="stylesheet" href="css/search.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<header>
    <div class="wrapper">
        <div class="logo">
            <img src='images/logo1.jpg' alt='JobQuest Logo'>
        </div>
        <ul class="nav-area">
            <li>
                <a href="search.php">Job Search<img src="images/search-icon.png" alt="" class="nav-icon" width="22" height="22"></a>
            </li>
            <li><a href="jobseeker-home.php">Homepage</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="review.php">Review</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</header>
<body>

<h1>Search for Jobs</h1>

<form id="jobSearchForm">
    <div class="search-boxes">
        <div class="search-box full-width">
            <label for="search_title">Job Title</label>
            <input type="text" name="search_title" id="search_title" placeholder="e.g. Developer">
        </div>
        <div class="half-row">
            <div class="search-box half-box">
                <label for="search_category">Job Category</label>
                <select name="search_category" id="search_category">
                    <option value="">Select Category</option>
                    <option value="IT & Software Development">IT & Software Development</option>
                    <option value="Design & Arts">Design & Arts</option>
                    <option value="Product Management">Product Management</option>
                    <option value= "Finance & Accounting">Finance & Accounting</option>
                    <option value= "Human Resources">Human Resources</option>
                    <option value="Marketing & Communications">Marketing & Communications</option>
                    <option value="Legal">Legal</option>
                </select>
            </div>    
        </div>
        <div class="search-box half-box">
            <label for="search_type">Job Type</label>
            <select name="search_type" id="search_type">
                <option value="">Select Job Type</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
            </select>
        </div>
    </div>
    <button type="submit">Search</button>
</form>

<div class="job-results" id="jobResults">
    <!-- Results will be displayed here -->
</div>

<script>
$(document).ready(function () {
    function fetchJobs() {
        const formData = $('#jobSearchForm').serialize();
        $.ajax({
            url: 'fetch-jobs.php',
            method: 'POST',
            data: formData,
            success: function (response) {
                $('#jobResults').html(response);
            },
            error: function () {
                $('#jobResults').html('<p>Error fetching jobs.</p>');
            }
        });
    }

    // Fetch all jobs on page load
    fetchJobs();

    // Trigger AJAX when form is submitted
    $('#jobSearchForm').on('submit', function (e) {
        e.preventDefault();
        fetchJobs();
    });
});
</script>

</body>
</html>
