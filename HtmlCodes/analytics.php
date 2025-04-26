<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Analytics Widget</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/analytics.css">
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img src="images/logo1.jpg" alt="JobQuest Logo" class="logo">
            <span class="text">JobQuest</span>
        </a>
        <h1>Hello Admin!</h1>
        <ul class="side-menu top">
            <li>
                <a href="admin-home.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="manage_employer.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Manage Employers</span>
                </a>
            </li>
            <li>
                <a href="manage_jobseeker.php">
                    <i class='bx bxs-group'></i>
                    <span class="text">Manage Jobseekers</span>
                </a>
            </li>
            <li>
                <a href="manage_jobs.php">
                    <i class='bx bxs-pen'></i>
                    <span class="text">Manage Jobs</span>
                </a>
            </li>
            <li>
                <a href="manageApp.php">
                    <i class='bx bxs-book-open'></i>
                    <span class="text">Manage Applications</span>
                </a>
            </li>
            <li class="active">
                <a href="analytics.php">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Analytics</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
            <li>
                <a href="adminLogout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <?php include("navbarAdmin.php"); ?>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Analytics</h1>
                </div>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: left;">

                <!-- Bar Chart -->
                <div class="chart-card">
                    <h3>Employer Registrations</h3>
                    <div class="bar-chart">
                        <div class="bar" style="height: 75%;">75%</div>
                        <div class="bar" style="height: 50%;">50%</div>
                        <div class="bar" style="height: 90%;">90%</div>
                        <div class="bar" style="height: 65%;">65%</div>
                        <div class="bar" style="height: 80%;">80%</div>
                    </div>
                    <div class="bar-labels">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>May</span>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="chart-card">
                    <h3>Applications Status</h3>
                    <div class="pie-chart">
                        <div class="slice pending"></div>
                        <div class="slice accepted"></div>
                        <div class="slice rejected"></div>
                    </div>
                    <div class="pie-legend">
                        <span><span class="legend-color pending"></span>Pending</span>
                        <span><span class="legend-color accepted"></span>Accepted</span>
                        <span><span class="legend-color rejected"></span>Rejected</span>
                    </div>
                </div>

                <!-- Line Graph -->
                <div class="line-graph-card">
                    <h3>Active Users Over Time</h3>
                    <canvas id="lineGraph" width="400" height="200"></canvas>
                </div>

                <!-- NEW Doughnut Chart for Job Category Popularity -->
                <div class="doughnut-card">
                    <h3>Job Category Popularity</h3>
                    <canvas id="jobCategoryChart"></canvas>
                </div>

            </div>

            <!-- Widgets -->
            <div class="widgets">
                <div class="widget">
                    <h4>Total Employers</h4>
                    <p>350+</p>
                </div>
                <div class="widget">
                    <h4>Total Job Seekers</h4>
                    <p>1200+</p>
                </div>
                <div class="widget">
                    <h4>Jobs Available</h4>
                    <p>180+</p>
                </div>
            </div>

        </main>
    </section>

    <!-- CHART.JS SCRIPTS -->
    <script>
        // Line Graph
        const ctx = document.getElementById('lineGraph').getContext('2d');
        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Active Users',
                    data: [5, 10, 7, 12, 8, 15, 10],
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Doughnut Chart for Job Category
        const ctxDoughnut = document.getElementById('jobCategoryChart').getContext('2d');
        const jobCategoryChart = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['IT', 'Finance & Accounting', 'Human Resources', 'Product Management', 'Others'],
                datasets: [{
                    label: 'Job Categories',
                    data: [40, 25, 15, 10, 10],
                    backgroundColor: [
                        '#a2d2ff', // light blue
                        '#caffbf', // light green
                        '#ffd6a5', // light orange
                        '#ffadad', // light red
                        '#d0cde1'  // soft lavender
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#666',
                            font: {
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: false,
                    }
                }
            }
        });
    </script>

    <!-- SIDEBAR + Search Scripts -->
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

        document.getElementById("employerSearchInput")?.addEventListener("keyup", function() {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll("#employer-table tbody tr");

            rows.forEach(row => {
                const companyName = row.cells[1].textContent.toLowerCase();
                const contactNumber = row.cells[5].textContent.toLowerCase();
                const email = row.cells[6].textContent.toLowerCase();

                if (companyName.includes(input) || contactNumber.includes(input) || email.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
