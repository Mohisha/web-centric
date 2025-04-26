    <section id="sidebar">
            <a href="#" class="brand">
                <img src="images/logo1.jpg" alt="JobQuest Logo" class="logo">
                <span class="text">JobQuest</span>
            </a>
            <h1>Hello Admin!</h1>
            <ul class="side-menu top">
                <li class= "active">
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
                <li>
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

                // Search Button Toggle
                $('#content nav form .form-input button').on('click', function (e) {
                if ($(window).width() < 576) {
                    e.preventDefault();
                    $('#content nav form').toggleClass('show');
                    const buttonIcon = $(this).find('.bx');
                    if ($('#content nav form').hasClass('show')) {
                    buttonIcon.removeClass('bx-search').addClass('bx-x');
                    } else {
                    buttonIcon.removeClass('bx-x').addClass('bx-search');
                    }
                }
                });

                // Responsive Adjustments for Sidebar and Search
                if ($(window).width() < 768) {
                $('#sidebar').addClass('hide');
                } else if ($(window).width() > 576) {
                $('#content nav form .form-input button .bx').removeClass('bx-x').addClass('bx-search');
                $('#content nav form').removeClass('show');
                }

                // Window Resize Event
                $(window).on('resize', function () {
                if ($(this).width() > 576) {
                    $('#content nav form .form-input button .bx').removeClass('bx-x').addClass('bx-search');
                    $('#content nav form').removeClass('show');
                }
                });
                
            });
    </script>