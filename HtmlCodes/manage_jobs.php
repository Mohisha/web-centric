<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/manageJobs.css">
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
            <li class="active">
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
            <li>
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

    <section id="content">
        <?php 
            include("navbarAdmin.php");
        ?>
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Manage Jobs</h1>
                </div>
                <div class="search-container">
                    <input type="text" id="jobSearchInput" placeholder="Search jobs by title, location..." />
                    <div class="filter-container">
                        <select id="jobTypeFilter">
                            <option value="">All Job Types</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="jobs-grid" id="jobsContainer">
                <!-- Jobs will be loaded here dynamically -->
            </div>
        </main>
    </section>
    
    <!-- View/Edit Job Modal -->
    <div id="jobModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2 id="modalTitle">Job Details</h2>
            <form id="jobForm">
                <input type="hidden" id="jobId">
                <div class="form-group">
                    <label for="empId">Employee ID</label>
                    <input type="text" id="empId" name="empId">
                </div>
                <div class="form-group">
                    <label for="title">Job Title</label>
                    <input type="text" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location">
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" id="salary" name="salary">
                </div>
                <div class="form-group">
                    <label for="jobType">Job Type</label>
                    <select id="jobType" name="jobType">
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jobCategory">Job Category</label>
                    <input type="text" id="jobCategory" name="jobCategory">
                </div>
                <div class="form-group">
                    <label for="yearsOfExperience">Years of Experience</label>
                    <input type="number" id="yearsOfExperience" name="yearsOfExperience" min="0">
                </div>
                <div class="form-buttons">
                    <button type="button" id="cancelBtn" class="btn btn-cancel">Cancel</button>
                    <button type="button" id="saveBtn" class="btn btn-save">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
    $(document).ready(function() {
        // Load all jobs on page load
        loadJobs();
        
        // Toggle sidebar
        $('#content nav .bx.bx-menu').on('click', function() {
            $('#sidebar').toggleClass('hide');
        });
        
        // Sidebar Menu Toggle Active Class
        $('#sidebar .side-menu.top li a').on('click', function() {
            $('#sidebar .side-menu.top li').removeClass('active');
            $(this).parent().addClass('active');
        });
        
        // Job search functionality
        $("#jobSearchInput").on("keyup", function() {
            const searchTerm = $(this).val().toLowerCase();
            $(".job-card").each(function() {
                const title = $(this).find(".job-title").text().toLowerCase();
                const location = $(this).find(".job-location").text().toLowerCase();
                const type = $(this).find(".job-type").text().toLowerCase();
                
                if (title.includes(searchTerm) || location.includes(searchTerm) || type.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        
        // Job type filter
        $("#jobTypeFilter").on("change", function() {
            const filterValue = $(this).val().toLowerCase();
            
            if (filterValue === "") {
                $(".job-card").show();
            } else {
                $(".job-card").each(function() {
                    const jobType = $(this).find(".job-type").text().toLowerCase();
                    
                    if (jobType === filterValue) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
        
        // Close modal when clicking X or Cancel
        $("#closeModal, #cancelBtn").click(function() {
            $("#jobModal").hide();
        });
        
        // Close modal when clicking outside of it
        $(window).click(function(event) {
            if ($(event.target).is('.modal')) {
                $(".modal").hide();
            }
        });
        
        // Save job changes
        $("#saveBtn").click(function() {
            const jobData = {
                "JobID": $("#jobId").val(),
                "EmpID": $("#empId").val(),
                "Title": $("#title").val(),
                "Description": $("#description").val(),
                "Location": $("#location").val(),
                "Salary": $("#salary").val(),
                "JobType": $("#jobType").val(),
                "JobCategory": $("#jobCategory").val(),
                "YearsOfExperience": $("#yearsOfExperience").val()
            };
            console.log(jobData);
            $.ajax({
                url: 'update_job.php?id=' + jobData.JobID,
                type: 'POST',
                data: jobData,
                success: function(response) {
                    alert('Job updated successfully!');
                    $("#jobModal").hide();
                    loadJobs(); // Reload the jobs
                },
                error: function(xhr, status, error) {
                    alert('Error updating job: ' + error);
                }
            });
        });
    });
    
    // Function to load all jobs
    function loadJobs() {
        $.ajax({
            url: 'get_alljobs.php',
            type: 'GET',
            dataType: 'json',
            success: function(jobs) {
                const jobsContainer = $("#jobsContainer");
                jobsContainer.empty();
                
                jobs.forEach(function(job) {
                    const jobCard = `
                        <div class="job-card" data-id="${job.JobID}">
                            <div class="job-title">${job.Title}</div>
                            <div class="job-location">${job.Location}</div>
                            <div class="job-salary">${job.Salary}</div>
                            <div class="job-type">${job.JobType}</div>
                            <div class="job-date">Posted: ${formatDate(job.DatePosted)}</div>
                            <div class="job-buttons">
                                <button class="btn btn-view" data-id="${job.JobID}">View More</button>
                                <button class="btn btn-edit" data-id="${job.JobID}">Edit</button>
                                <button class="btn btn-delete" data-id="${job.JobID}">Delete</button>
                            </div>
                        </div>
                        `;
                    jobsContainer.append(jobCard);

                });
               
            },
            error: function(xhr, status, error) {
                console.error('Error loading jobs:', error);
                $("#jobsContainer").html('<p>Error loading jobs. Please try again later.</p>');
            }
        });
    }

    $("body").on("click", "button.btn-view", function () {
        const jobId = $(this).attr("data-id");
        console.log("Clicked job ID:", jobId);
        viewJob(jobId); 
    });

    $("body").on("click", "button.btn-edit", function () {
        const jobId = $(this).attr("data-id");
        console.log("Clicked job ID:", jobId);
        editJob(jobId); 
    });

    $("body").on("click", "button.btn-delete", function () {
        const jobId = $(this).attr("data-id");
        console.log("Clicked job ID:", jobId);
        deleteJob(jobId); 
    });

    

    // Function to view job details
    function viewJob(jobId) {
        $.ajax({
            url: `get_job.php?id=${jobId}`,
            type: 'GET',
            dataType: 'json',
            success: function(job) {
                // Fill the form with job data but make fields readonly
                $("#modalTitle").text("Job Details");
                $("#jobId").val(job.JobID);
                $("#empId").val(job.EmpID).prop('readonly', true);
                $("#title").val(job.Title).prop('readonly', true);
                $("#description").val(job.Description).prop('readonly', true);
                $("#location").val(job.Location).prop('readonly', true);
                $("#salary").val(job.Salary).prop('readonly', true);
                $("#jobType").val(job.JobType).prop('disabled', true);
                $("#jobCategory").val(job.JobCategory).prop('readonly', true);
                $("#yearsOfExperience").val(job.YearsOfExperience).prop('readonly', true);
                
                // Hide Save button, show only Cancel
                $("#saveBtn").hide();
                $("#cancelBtn").text("Close");
                
                // Show the modal
                $("#jobModal").show();
            },
            error: function(xhr, status, error) {
                alert('Error loading job details: ' + error);
            }
        });
    }
    
    // Function to edit job
    function editJob(jobId) {
        $.ajax({
            url: `get_job.php?id=${jobId}`,
            type: 'POST',
            dataType: 'json',
            success: function(job) {
                // Fill the form with job data but make fields readonly
                $("#modalTitle").text("Job Details");
                $("#jobId").val(job.JobID);
                $("#empId").val(job.EmpID).prop('readonly', false);
                $("#title").val(job.Title).prop('readonly', false);
                $("#description").val(job.Description).prop('readonly', false);
                $("#location").val(job.Location).prop('readonly', false);
                $("#salary").val(job.Salary).prop('readonly', false);
                $("#jobType").val(job.JobType).prop('disabled', false);
                $("#jobCategory").val(job.JobCategory).prop('readonly', false);
                $("#yearsOfExperience").val(job.YearsOfExperience).prop('readonly', false);
                // Show both buttons
                $("#saveBtn").show();
                $("#cancelBtn").text("Cancel");
                
                // Show the modal
                $("#jobModal").show();
            },
            error: function(xhr, status, error) {
                alert('Error loading job details: ' + error);
            }
        });
    }
    
    $(document).on('click', '.btn-delete', function() {
    const jobId = $(this).closest('.job-card').data('id');

        if (confirm('Are you sure you want to delete this job?')) {
            $.ajax({
                url: 'delete_job.php',
                type: 'POST',
                data: { JobID: jobId },
                success: function(response) {
                    if (response.success) {
                        alert(response.success);
                        loadJobs(); // Reload jobs after deletion
                    } else {
                        alert(response.error);
                    }
                },
                error: function(xhr, status, error) {
                    alert('AJAX error: ' + error);
                }
            });
        }
    });

    
    // Function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString();
    }
    </script>
</body>
</html>