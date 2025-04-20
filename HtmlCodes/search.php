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
        body {
        font-family: Arial, sans-serif;
        background-color: #f4f6f8;
        background-image: url('https://cdn.sanity.io/images/uqxwe2qj/production/4ee9fb18bdc214aefebf7859557a6611125c3841-760x426.png?q=80&auto=format&fit=clip&w=760');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        padding: 30px;
        margin: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        form {
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .search-boxes {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }

        .full-width {
            width: 100%;
            max-width: 600px;
            margin:0;
        }

        .half-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .half-box {
            flex: 1 1 calc(50% - 10px);
            min-width: 150px;
            max-width: 600px; /* Limit the max width */
        }

        .search-box label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .search-box input,
        .search-box select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .search-box input:focus,
        .search-box select:focus {
            outline: none;
            border-color: #007bff;
            background-color: #fff;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .job-results {
            max-width: 900px;
            margin: 30px auto;
        }

        .job-results ul {
            list-style: none;
            padding: 0;
        }

        .job-results li {
            background-color: #fff;
            margin-bottom: 15px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.07);
            border: 1px solid #e0e0e0;
        }


</style>

</head>
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
