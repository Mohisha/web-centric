<?php
session_start();
require_once 'database.php'; 

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

$jobseekerID = $_SESSION['UserID'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Job Applications</title>
    <link rel="stylesheet" href="css/application.css"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php
        include("nav.php");
    ?>
    <!-- Applications Section -->
    <div class="application-container">
        <h2>Your Job Applications</h2>
        <div id="applications-list">
        </div>
    </div>

    <!-- Loading Spinner (hidden by default) -->
    <div id="loading-spinner" style="display: none;">Loading...</div>

    <script>
        $(document).ready(function () {
            // Function to fetch applications
            function fetchApplications() {
                $('#loading-spinner').show(); // Show the loading spinner
                $.ajax({
                    url: 'fetch_applications.php', // The PHP file to fetch applications
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $('#loading-spinner').hide(); // Hide the loading spinner
                        $('#applications-list').empty(); // Clear previous data

                        if (data.length === 0) {
                            $('#applications-list').append('<p>No applications found.</p>');
                        } else {
                            data.forEach(function (application) {
                                // Create an HTML structure for each application
                                var applicationHTML = `
                                    <div class="application-card">
                                        <h3>${application.Title}</h3>
                                        <p><strong>Location:</strong> ${application.Location}</p>
                                        <p><strong>Applied on:</strong> ${application.DateApplied}</p>
                                        <p><strong>Status:</strong> ${application.Status}</p>
                                        <p><strong>Cover Letter:</strong> ${application.CoverLetter}</p>
                                        <p><strong>CV:</strong> <a href="${application.ResumeFilePath}" target="_blank">View CV</a></p>
                                        <p><strong>Job Description:</strong> ${application.Description}</p>
                                        <p><strong>Salary:</strong> ${application.Salary}</p>
                                        <p><strong>Job Type:</strong> ${application.JobType}</p>
                                        <p><strong>Category:</strong> ${application.JobCategory}</p>
                                    </div>

                                `;
                                $('#applications-list').append(applicationHTML);
                            });
                        }
                    },
                    error: function () {
                        $('#loading-spinner').hide(); // Hide the loading spinner
                        $('#applications-list').html('<p>Error fetching applications. Please try again later.</p>');
                    }
                });
            }

            // Fetch applications on page load
            fetchApplications();
        });
    </script>
</body>
</html>
