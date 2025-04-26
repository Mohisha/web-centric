<?php
include 'database.php';

$sql = "SELECT 
            a.ApplicationID, 
            a.JobID, 
            a.JobSeekerID, 
            a.ResumeFilePath, 
            a.DateApplied, 
            a.Status, 
            a.CoverLetter,
            j.Title AS Title,
            js.FullName AS FullName
        FROM application a
        JOIN jobs j ON a.JobID = j.JobID
        JOIN jobseeker js ON a.JobSeekerID = js.JobSeekerID";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="app-card">
            <p><strong>Application ID:</strong> <?= htmlspecialchars($row['ApplicationID']) ?></p>
            <p><strong>Job Title:</strong> <?= htmlspecialchars($row['Title']) ?></p>
            <p><strong>Job Seeker:</strong> <?= htmlspecialchars($row['FullName']) ?></p>
            <p><strong>Resume:</strong> <a href="<?= htmlspecialchars($row['ResumeFilePath']) ?>" target="_blank">View</a></p>
            <p><strong>Date Applied:</strong> <?= htmlspecialchars($row['DateApplied']) ?></p>
            <p><strong>Cover Letter:</strong> <?= nl2br(htmlspecialchars($row['CoverLetter'])) ?></p>

            <label><strong>Status:</strong></label>
            <select class="status-select" id="status_<?= $row['ApplicationID'] ?>">
                <?php
                $statuses = ['Pending', 'Processed', 'Cancelled'];
                foreach ($statuses as $status) {
                    $selected = $row['Status'] === $status ? 'selected' : '';
                    echo "<option value='$status' $selected>$status</option>";
                }
                ?>
            </select>

            <div class="card-actions">
                <button onclick="updateApplication('<?= $row['ApplicationID'] ?>')">Save</button>
                <button onclick="deleteApplication('<?= $row['ApplicationID'] ?>')">Delete</button>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>No applications found.</p>";
}
?>
