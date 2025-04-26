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
                <a href="analytics.php">
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
                <a href="adminLogout.php" class="logout">
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
                    <h1>Manage Applications</h1>
                </div>
                <input type="text" id="applicationSearchInput" placeholder="Search by applicant name, job title, status..." />
            </div>

            <script>
                $(document).ready(function () {
                    // Fetch applications from your PHP API
                    function fetchApplications() {
                        $.ajax({
                            url: 'fetchApp.php', // <-- your backend PHP service
                            method: 'GET',
                            dataType: 'json',
                            success: function (data) {
                                renderApplications(data);
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });
                    }

                    // Render the application cards
                    function renderApplications(applications) {
                        const container = $('<div class="application-cards"></div>'); // main container
                        
                        applications.forEach(app => {
                            const card = $(`
                                <div class="application-card">
                                    <input type="hidden" class="jobID" value="${app.JobID}">
                                    <input type="hidden" class="jobSeekerID" value="${app.JobSeekerID}">
                                    <input type="hidden" class="resumeFilePath" value="${app.ResumeFilePath}">
                                    <input type="hidden" class="dateApplied" value="${app.DateApplied}">

                                    <div><strong>Application ID:</strong> <input type="text" class="applicationID" value="${app.ApplicationID}" disabled></div>
                                    <div><strong>Job Title:</strong> <input type="text" class="jobTitle" value="${app.JobTitle}" disabled></div>
                                    <div><strong>Applicant Name:</strong> <input type="text" class="fullName" value="${app.FullName}" disabled></div>
                                    <div><strong>Resume:</strong> <a href="${app.ResumeFilePath}" target="_blank">View Resume</a></div>
                                    <div><strong>Date Applied:</strong> <input type="date" class="dateAppliedVisible" value="${app.DateApplied}" disabled></div>
                                    <div><strong>Status:</strong> 
                                        <select class="statusSelect" disabled>
                                            <option value="Select Status">Select Status</option>
                                            <option value="Pending" ${app.Status === "Pending" ? "selected" : ""}>Pending</option>
                                            <option value="Processed" ${app.Status === "Processed" ? "selected" : ""}>Processed</option>
                                            <option value="Cancelled" ${app.Status === "Cancelled" ? "selected" : ""}>Cancelled</option>
                                        </select>
                                    </div>
                                    <div><strong>Cover Letter:</strong> 
                                        <textarea class="coverLetter" rows="3" disabled>${app.CoverLetter}</textarea>
                                    </div>

                                    <div class="button-group">
                                        <button class="edit-btn">Edit</button>
                                        <button class="save-btn" style="display:none;">Save</button>
                                        <button class="delete-btn">Delete</button>
                                    </div>
                                </div>
                            `);

                            // Handle Edit
                            card.find('.edit-btn').click(function () {
                                card.find('input, select, textarea').prop('disabled', false);
                                card.find('.save-btn').show();
                                $(this).hide();
                            });

                            // Handle Save
                            card.find('.save-btn').click(function () {
                                const updatedApp = {
                                    ApplicationID: card.find('.applicationID').val(),
                                    JobID: card.find('.jobID').val(),            
                                    JobSeekerID: card.find('.jobSeekerID').val(),
                                    ResumeFilePath: card.find('.resumeFilePath').val(), 
                                    DateApplied: card.find('.dateApplied').val(),
                                    Status: card.find('.statusSelect').val(),
                                    CoverLetter: card.find('.coverLetter').val()
                                };

                                $.ajax({
                                    url: 'updateApp.php',
                                    method: 'POST',
                                    data: updatedApp,
                                    dataType: 'json', 
                                    success: function (response) {
                                        if (response.success) {
                                            alert(response.message);
                                            card.find('input, select, textarea').prop('disabled', true);
                                            card.find('.edit-btn').show();
                                            card.find('.save-btn').hide();
                                        } else {
                                            alert('Failed to update: ' + response.message);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(error);
                                        alert('Error updating application.');
                                    }
                                });
                            });

                            // Handle Delete
                            card.find('.delete-btn').click(function () {
                                if (confirm("Are you sure you want to delete this application?")) {
                                    $.ajax({
                                        url: 'deleteApp.php',
                                        method: 'POST',
                                        data: { ApplicationID: card.find('.applicationID').val() },
                                        success: function (response) {
                                            alert('Application deleted successfully!');
                                            card.remove();
                                        },
                                        error: function (xhr, status, error) {
                                            console.error(error);
                                            alert('Error deleting application.');
                                        }
                                    });
                                }
                            });

                            container.append(card);
                        });

                        $('main').append(container);
                    }

                    fetchApplications(); // Initial fetch

                    // Search functionality
                    $('#applicationSearchInput').on('keyup', function() {
                        const searchTerm = $(this).val().toLowerCase();
                        $('.application-card').each(function() {
                            const fullName = $(this).find('.fullName').val().toLowerCase();
                            const jobTitle = $(this).find('.jobTitle').val().toLowerCase();
                            const status = $(this).find('.statusSelect').val().toLowerCase();
                            if (fullName.includes(searchTerm) || jobTitle.includes(searchTerm) || status.includes(searchTerm)) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                });

});


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
        
    </script>
</body>
</html>
