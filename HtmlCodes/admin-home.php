<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="css/admin.css">

	<title>Admin</title>
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
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Manage Employers</span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Manage Jobseekers</span>
				</a>
			</li>
            <li>
				<a href="#">
					<i class='bx bxs-pen' ></i>
					<span class="text">Manage Jobs</span>
				</a>
			</li>
            <li>
				<a href="#">
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
			<li>
				<a href="#">
					<i class='bx bxs-message-dots' ></i>
					<span class="text">Message</span>
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
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>

			<a href="#" class="profile">
				<img src="images/admin.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
				</div>
			</div>

			<ul class="box-info">
				<li>
                    <img src="images/users.png" alt="Job Postings Icon" style="width: 60px; height: 60px;">
					<span class="text">
						<h3>1250</h3>
						<p>Total Users</p>
					</span>
				</li>
				<li>
                    <img src="images/job.png" alt="Job Postings Icon" style="width: 60px; height: 60px;">
                    <span class="text">
                        <h3>82</h3>
                        <p>Job Postings</p>
                    </span>
				</li>
				<li>
                    <img src="images/visitors.png" alt="Job Postings Icon" style="width: 60px; height: 60px;">
					<span class="text">
						<h3>3200</h3>
						<p>Total Visitors</p>
					</span>
				</li>
                <li>
                    <img src="images/application.png" alt="Job Postings Icon" style="width: 60px; height: 60px;">
					<span class="text">
						<h3>100+</h3>
						<p>Applications</p>
					</span>
				</li>
                <li>
                    <img src="images/interview.png" alt="Job Postings Icon" style="width: 60px; height: 60px;">
					<span class="text">
						<h3>48</h3>
						<p>Interviews Scheduled</p>
					</span>
				</li>
                <li>
                    <img src="images/growth.png" alt="Job Postings Icon" style="width: 60px; height: 60px;">
					<span class="text">
						<h3>230</h3>
						<p>New Users This Month</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Users</h3>
						<input type="text" id="userSearchInput" placeholder="Search by name..." />
                        <i class='bx bx-search'></i>
                        <i class='bx bx-filter'></i>
					</div>
					<table id="recent-users-table">
						<thead>
							<tr>
								<th>UserName</th>
                                <th>Contact</th>
								<th>Email Address</th>
								<th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
							</tr>
						</thead>
						<tbody>
                            <script>
                                $(document).ready(function() {
                                    function loadUsers() {
                                        $.ajax({
                                            url: 'fetch_allusers.php',
                                            method: 'GET',
                                            dataType: 'json',
                                            success: function(data) {
                                                var tbody = $('#recent-users-table tbody');
                                                tbody.empty();
                                                data.forEach(function(user) {
                                                    var row = `<tr data-id="${user.UserID}">
                                                        <td contenteditable="true" class="username">${user.UserName}</td>
                                                        <td contenteditable="true" class="contact">${user.Contact}</td>
                                                        <td contenteditable="true" class="email">${user.Email}</td>
                                                        <td contenteditable="true" class="role ${user.Role.toLowerCase()}">${user.Role}</td>
                                                        <td contenteditable="true" class="status ${user.Status.toLowerCase()}">${user.Status}</td>
                                                        <td><button class="save-btn"> Save </button></td>
                                                    </tr>`;
                                                    console.log(user);
                                                    tbody.append(row);
                                                });
                                            }
                                        });
                                    }

                                    loadUsers();

                                    $('#recent-users-table').on('click', '.save-btn', function() {
                                        var row = $(this).closest('tr');
                                        var id = row.data('id');
                                        var username = row.find('.username').text();
                                        var contact = row.find('.contact').text();
                                        var email = row.find('.email').text();
                                        var role = row.find('.role').text();
                                        var status = row.find('.status').text();

                                        $.ajax({
                                            url: 'update_user.php',
                                            method: 'POST',
                                            contentType: 'application/json',
                                            data: JSON.stringify({
                                                UserID: id,
                                                UserName: username,
                                                Contact: contact,
                                                Email: email,
                                                Role: role,
                                                Status: status
                                            }),
                                            success: function(response) {
                                                var res = JSON.parse(response);
                                                if (res.success) {
                                                    alert('User updated successfully.');
                                                } else {
                                                    alert('Error: ' + res.error);
                                                }
                                            }
                                        });
                                    });
                                });
                            </script>	
						</tbody>
					</table>
				</div>
			
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
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


        
        document.getElementById("userSearchInput").addEventListener("keyup", function() {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll("#recent-users-table tbody tr");

            rows.forEach(row => {
                const username = row.cells[0].textContent.toLowerCase();
                const contact = row.cells[1].textContent.toLowerCase();
                const email = row.cells[2].textContent.toLowerCase();

                if (username.includes(input) || contact.includes(input) || email.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });


    </script>
    

</body>
</html>