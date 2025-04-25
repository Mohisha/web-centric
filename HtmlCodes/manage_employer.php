<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Employers</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/manageEmp.css">
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
                        <i class='bx bxs-dashboard' ></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="active">
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
        <?php 
			include("navbarAdmin.php");
        ?>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Manage Employers</h1>
                </div>
                <input type="text" id="employerSearchInput" placeholder="Search by company name,email,phone..." />
            </div>

            <table id="employer-table">
                <thead>
                    <tr>
                        <th>Employer ID</th>
                        <th>Company Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will load here -->
                </tbody>
            </table>

            <div class="side-panel" id="sidePanel">
                <h3>Edit Employer</h3>
                <form id="editForm">
                    <input type="hidden" id="EmployerID">
                    <div class="form-group"><label>Company Name:<input type="text" id="CompanyName"></label></div>
                    <div class="form-group"><label for="Description">Description:</label><textarea id="Description" class="descriptionBox"></textarea></div>
                    <div class="form-group"><label>Start Date:<input type="date" id="StartDate"></label></div>
                    <div class="form-group"><label>Address:<input type="text" id="Address"></label></div>
                    <div class="form-group"><label>Contact Number:<input type="text" id="ContactNumber"></label></div>
                    <div class="form-group"><label>Email:<input type="email" id="Email"></label></div>
                    <div class="form-group"><label>Website:<input type="text" id="Website"></label></div>
                    <button type="button" id="saveBtn">Save</button>
                    <button type="button" id="deleteBtn">Delete</button>
                    <button type="button" id="cancelBtn">Cancel</button>

                </form>
            </div>

            <script>
                function loadEmployers() {
                    $.getJSON("get_employers.php", function(data) {
                        const tbody = $("#employer-table tbody");
                        tbody.empty();
                        data.data.forEach(emp => {
                            tbody.append(`
                                <tr data-id="${emp.EmployerID}">
                                    <td>${emp.EmployerID}</td>
                                    <td>${emp.CompanyName}</td>
                                    <td>${emp.Description}</td>
                                    <td>${emp.StartDate}</td>
                                    <td>${emp.Address}</td>
                                    <td>${emp.ContactNumber}</td>
                                    <td>${emp.Email}</td>
                                    <td>${emp.Website}</td>
                                    <td><button class="editBtn">Edit</button></td>
                                </tr>`);
                        });
                    });
                }

                $(document).on("click", ".editBtn", function() {
                    const row = $(this).closest("tr");
                    $("#EmployerID").val(row.data("id"));
                    $("#CompanyName").val(row.find("td:eq(1)").text());
                    $("#Description").val(row.find("td:eq(2)").text());
                    $("#StartDate").val(row.find("td:eq(3)").text());
                    $("#Address").val(row.find("td:eq(4)").text());
                    $("#ContactNumber").val(row.find("td:eq(5)").text());
                    $("#Email").val(row.find("td:eq(6)").text());
                    $("#Website").val(row.find("td:eq(7)").text());
                    $("#sidePanel").addClass("open");
                });

                $("#saveBtn").click(function() {
                    const data = {
                        EmployerID: $("#EmployerID").val(),
                        CompanyName: $("#CompanyName").val(),
                        Description: $("#Description").val(),
                        StartDate: $("#StartDate").val(),
                        Address: $("#Address").val(),
                        ContactNumber: $("#ContactNumber").val(),
                        Email: $("#Email").val(),
                        Website: $("#Website").val()
                    };
                    $.ajax({
                        url: "update_employer.php",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify(data),
                        success: function(res) {
                            if (res.status === 'success') {
                                alert("Updated successfully");
                                $("#sidePanel").removeClass("open");
                                loadEmployers();
                            }else {
                                alert("Error: " + res.message);
                            }
                        }
                        // error: function(err) {
                        //     console.error("AJAX error:", err);
                        //     alert("Server error occurred");
                        // }
                    });
                });

                $("#deleteBtn").click(function() {
                    const id = $("#EmployerID").val();
                    $.ajax({
                        url: "delete_employer.php",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({ ids: [parseInt(id)] }),
                        success: function(res) {
                            if (res.status === 'success') {
                                alert("Deleted successfully");
                                $("#sidePanel").removeClass("open");
                                loadEmployers();
                            }
                        }
                    });
                });

                // Cancel button functionality
                document.getElementById("cancelBtn").addEventListener("click", function() {
                    document.getElementById("sidePanel").classList.remove("open");
                });


                $(document).ready(loadEmployers);
            </script>
        </main>
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
        
        document.getElementById("employerSearchInput").addEventListener("keyup", function() {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll("#employer-table tbody tr");

            rows.forEach(row => {
                const companyName = row.cells[1].textContent.toLowerCase(); // Company Name is in the second column
                const contactNumber = row.cells[5].textContent.toLowerCase(); // Contact Number is in the sixth column
                const email = row.cells[6].textContent.toLowerCase(); // Email is in the seventh column

                // Check if the input matches any of the columns
                if (companyName.includes(input) || contactNumber.includes(input) || email.includes(input)) {
                    row.style.display = ""; // Show the row if there's a match
                } else {
                    row.style.display = "none"; // Hide the row if there's no match
                }
            });
        });



    </script>
</body>
</html>
