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
	<?php
		include("sidebar.php")
	?>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php 
			include("navbarAdmin.php");
        ?>
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
						<h3>3250</h3>
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