<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Jobseekers</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/manageJobseekers.css">
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
            <li class="active">
                <a href="/web-centric/HtmlCodes/manage_jobseeker.php">
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
        <?php 
            include("navbarAdmin.php");
        ?>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Manage Jobseekers</h1>
                </div>
                <input type="text" id="jobseekerSearchInput" placeholder="Search by name,email,phone..." />
            </div>

            <table id="jobseeker-table">
                <thead>
                    <tr>
                        <th>Jobseeker ID</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Phone Number</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Profile</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will load here -->
                </tbody>
            </table>

            <div class="side-panel" id="sidePanel">
                <h3>Edit Jobseeker</h3>
                <form id="editForm">
                    <input type="hidden" id="JobSeekerID">
                    <div class="form-group"><label>Name:<input type="text" id="FullName"></label></div>
                    <div class="form-group"><label>Date of Birth:<input type="date" id="DateOfBirth"></label></div>
                    <div class="form-group"><label>Phone Number:<input type="text" id="PhoneNumber"></label></div>
                    <div class="form-group"><label>Gender:
                        <select id="Gender">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </label></div>
                    <div class="form-group"><label>Address:<input type="text" id="Address"></label></div>
                    <div class="form-group"><label>Profile:<textarea id="Profile" class="descriptionBox"></textarea></div>
                    <div class="form-group"><label>Email:<input type="email" id="Email"></label></div>

                    <button type="button" id="saveBtn">Save</button>
                    <button type="button" id="deleteBtn">Delete</button>
                    <button type="button" id="cancelBtn">Cancel</button>
                </form>
            </div>

            <script>
                function loadJobseekers() {
                    $.getJSON("get_jobseekers.php", function(data) {
                        const tbody = $("#jobseeker-table tbody");
                        tbody.empty();
                        data.data.forEach(js => {
                            tbody.append(`
                                <tr data-id="${js.JobSeekerID}">
                                    <td>${js.JobSeekerID}</td>
                                    <td>${js.FullName}</td>
                                    <td>${js.DateOfBirth}</td>
                                    <td>${js.PhoneNumber}</td>
                                    <td>${js.Gender}</td>
                                    <td>${js.Address}</td>
                                    <td>${js.Profile}</td>
                                    <td>${js.Email}</td>
                                    <td><button class="editBtn">Edit</button></td>
                                </tr>`);
                        });
                    });
                }

                $(document).on("click", ".editBtn", function() {
                    const row = $(this).closest("tr");
                    $("#JobSeekerID").val(row.data("id"));
                    $("#FullName").val(row.find("td:eq(1)").text());
                    $("#DateOfBirth").val(row.find("td:eq(2)").text());
                    $("#PhoneNumber").val(row.find("td:eq(3)").text());
                    $("#Gender").val(row.find("td:eq(4)").text());
                    $("#Address").val(row.find("td:eq(5)").text());
                    $("#Profile").val(row.find("td:eq(6)").text());
                    $("#Email").val(row.find("td:eq(7)").text());
                    $("#sidePanel").addClass("open");
                });

                $("#saveBtn").click(function() {
                    const data = {
                        JobSeekerID: $("#JobSeekerID").val(),
                        FullName: $("#FullName").val(),
                        DateOfBirth: $("#DateOfBirth").val(),
                        PhoneNumber: $("#PhoneNumber").val(),
                        Gender: $("#Gender").val(),
                        Address: $("#Address").val(),
                        Profile: $("#Profile").val(),
                        Email: $("#Email").val(),
                    };
                    $.ajax({
                        url: "update_jobseeker.php",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify(data),
                        success: function(res) {
                            if (res.status === 'success') {
                                alert("Updated successfully");
                                $("#sidePanel").removeClass("open");
                                loadJobseekers();
                            } else {
                                alert("Error: " + res.message);
                            }
                        }
                    });
                });

                $("#deleteBtn").click(function() {
                    const id = $("#JobSeekerID").val();
                    $.ajax({
                        url: "delete_jobseeker.php",
                        method: "POST",
                        contentType: "application/json",
                        data: JSON.stringify({ ids: [parseInt(id)] }),
                        success: function(res) {
                            if (res.status === 'success') {
                                alert("Deleted successfully");
                                $("#sidePanel").removeClass("open");
                                loadJobseekers();
                            }
                        }
                    });
                });

                // Cancel button functionality
                document.getElementById("cancelBtn").addEventListener("click", function() {
                    document.getElementById("sidePanel").classList.remove("open");
                });

                $(document).ready(loadJobseekers);
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
        
        document.getElementById("jobseekerSearchInput").addEventListener("keyup", function() {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll("#jobseeker-table tbody tr");

            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase(); // Name is in the second column
                const email = row.cells[2].textContent.toLowerCase(); // Email is in the third column
                const phone = row.cells[3].textContent.toLowerCase(); // Phone Number is in the fourth column

                // Check if the input matches any of the columns
                if (name.includes(input) || email.includes(input) || phone.includes(input)) {
                    row.style.display = ""; // Show the row if there's a match
                } else {
                    row.style.display = "none"; // Hide the row if there's no match
                }
            });
        });
    </script>
</body>
</html>
