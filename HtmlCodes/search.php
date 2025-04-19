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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .search-boxes {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .search-box {
            flex: 1;
        }
        .job-results ul {
            list-style: none;
            padding: 0;
        }
        .job-results li {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<h1>Search for Jobs</h1>

<form id="jobSearchForm">
    <div class="search-boxes">
        <div class="search-box">
            <label for="search_title">Job Title</label>
            <input type="text" name="search_title" id="search_title" placeholder="e.g. Developer, Nurse">
        </div>
        <div class="search-box">
            <label for="search_category">Job Category</label>
            <select name="search_category" id="search_category">
                <option value="">Select Category</option>
                <option value="IT">IT & Sotware Development</option>
                <option value="Design & Arts">Design & Arts</option>
                <option value="Product Management">Product Management</option>
            </select>
        </div>
        <div class="search-box">
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
