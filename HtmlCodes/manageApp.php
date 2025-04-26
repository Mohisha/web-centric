<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Applications</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/manageApp.css">
</head>
<body>
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/logo1.jpg" alt="JobQuest Logo" class="logo">
            <span class="text">JobQuest</span>
        </a>
        <h1>Hello Admin!</h1>
        <ul class="side-menu top">
            <li>
                <a href="admin-home.php">
                    <i class='bx bxs-dashboard' ></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="manage_employer.php">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Manage Employers</span>
                </a>
            </li>
            <li>
                <a href="manage_jobseeker.php">
                    <i class='bx bxs-group' ></i>
                    <span class="text">Manage Jobseekers</span>
                </a>
            </li>
            <li>
                <a href="manage_jobs.php">
                    <i class='bx bxs-pen' ></i>
                    <span class="text">Manage Jobs</span>
                </a>
            </li>
            <li class="active">
                <a href="manageApp.php">
                    <i class='bx bxs-book-open' ></i>
                    <span class="text">Manage Applications</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-doughnut-chart' ></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog' ></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <section id="content">
            <?php 
                include("navbarAdmin.php");
            ?>
        <div class="container">
            <h1>Manage Applications</h1>
            <div id="applications-container"></div>
        </div>
    </section>
    <script>

        $(document).ready(function () {
            // Sidebar Menu Toggle Active Class
            $('#sidebar .side-menu.top li a').on('click', function () {
                $('#sidebar .side-menu.top li').removeClass('active');
                $(this).parent().addClass('active');
            });
                
            // Toggle Sidebar
            $('#content nav .bx.bx-menu').on('click', function () {
                $('#sidebar').toggleClass('hide');
            });
        });
        
        function loadApplications() {
            fetch('fetchApp.php')
                .then(response => response.text())
                .then(html => {
                    document.getElementById('applications-container').innerHTML = html;
                });
        }

        function updateApplication(appId) {
            const status = document.getElementById(`status-${appId}`).value;
            const formData = new FormData();
            formData.append('application_id', appId);
            formData.append('status', status);

            fetch('updateApp.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                alert(result);
                loadApplications();
            });
        }

        function deleteApplication(appId) {
            if (confirm("Are you sure you want to delete this application?")) {
                const formData = new FormData();
                formData.append('application_id', appId);

                fetch('deleteApp.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    alert(result);
                    loadApplications();
                });
            }
        }

        window.onload = loadApplications;
    </script>
</body>
</html>