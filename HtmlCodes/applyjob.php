<?php
session_start();
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}
$jobID = $_GET['jobID'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Apply for Job</title>
  <link rel="stylesheet" href="css/applyjob.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    #successPopup {
      display: none;
      position: fixed;
      top: 30%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #4CAF50;
      color: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0px 2px 10px rgba(0,0,0,0.3);
      z-index: 9999;
    }
  </style>
</head>
<body>
    <?php
        include("nav.php");
    ?>

<div class="branding-text">JobQuest</div>
    <div class="profile-container">
    <h2>Apply for a Job</h2>
    <form id="applicationForm" method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="coverLetter">Cover Letter</label>
        <textarea name="coverLetter" id="coverLetter" rows="6" required></textarea>
        </div>

        <div class="form-group">
            <label for="cv">Upload CV</label>
            <div class="file-upload-wrapper">
                <label for="cvUpload" class="custom-file-label">Choose File</label>
                <input type="file" id="cvUpload" name="cv">
                <div id="file-name" class="file-name-display">No file chosen</div>
            </div>



        </div>

        
        <input type="hidden" name="jobID" value="<?php echo htmlspecialchars($jobID); ?>">
        <input type="hidden" name="jobseekerID" value="<?php echo htmlspecialchars($_SESSION['UserID']); ?>">
        <button type="submit">Submit Application</button>
    </form>
    </div>
<div id="successPopup">Job application submitted successfully!</div>

<script>
$('#applicationForm').on('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  $.ajax({
    url: 'submit_application.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json', // Expecting JSON response from server
    
    success: function(response) {
      console.log("Server response:", response);
      if (response.success) {
        $('#successPopup').fadeIn().delay(2000).fadeOut();
        $('#applicationForm')[0].reset();
      } else {
        alert("Error: " + response.message);
      }
    },
    
    error: function(xhr, status, error) {
      console.error("AJAX Error:", error);
      console.error("Response Text:", xhr.responseText);
      alert("AJAX Error: Server did not return valid JSON. Check console.");
    }
  });
});

</script>

<script>
    document.getElementById('cvUpload').addEventListener('change', function () {
        const fileName = this.files[0] ? this.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    });
</script>

</body>
</html>
