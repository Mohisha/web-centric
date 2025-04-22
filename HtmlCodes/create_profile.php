<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <link rel="stylesheet" href="css/profile.css"> <!-- Same styling as profile.php -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ajv/8.11.0/ajv.min.js"></script> <!-- JSON schema validator -->
</head>
<body>
    <?php 
        include("nav.php");
    ?>
<div class="branding-text">JobQuest</div>
<div class="container">

    <div class="profile-header">
        <div class="snapshot-container">
            <div class="profile-snapshot" data-initials="">
                <!-- Will display initials based on JS -->
            </div>
            <div class="upload-photo" title="Upload Photo">+</div>
        </div>
        <h2>Create your Profile <span class="profile-badge">Job Seeker</span></h2>
    </div>

    <form id="profileForm" method="POST" action="update_profile.php">
        <div class="form-column">
            <div class="field-group">
                <label for="FullName">Full Name:</label>
                <input type="text" id="FullName" name="FullName" placeholder="Enter your full name" required>
            </div>

            <div class="field-group">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" placeholder="Enter your email" required>
            </div>
        </div>

        <div class="form-column">
            <div class="field-group">
                <label for="PhoneNumber">Phone Number:</label>
                <input type="text" id="PhoneNumber" name="PhoneNumber" placeholder="Enter your phone number" required>
            </div>

            <div class="field-group">
                <label for="experience">Years of Experience</label>
                <input type="number" id="experience" name="experience" placeholder="Enter your experience in years">
            </div>
        </div>

        <div class="form-column full-width">
            <div class="field-group">
                <label for="Qualifications">Qualifications:</label>
                <textarea id="Qualifications" name="Qualifications" placeholder="Enter your qualifications" rows="4" required></textarea>

            </div>
        </div>

        <div class="form-column">
            <div class="field-group">
                <label for="education">Education Level</label>
                <select id="education" name="education" required>
                    <option value="">Select</option>
                    <option value="High School">High School</option>
                    <option value="Bachelor">Bachelor's Degree</option>
                    <option value="Master">Master's Degree</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>
        </div>

        <div class="button-container">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<script>
// JSON schema for validation
const schema = {
    type: "object",
    properties: {
        FullName: { type: "string", minLength: 1 },
        Email: { type: "string", format: "email" },
        PhoneNumber: { type: "string", pattern: "^[0-9\\-\\+]{9,15}$" },
        experience: { type: "number", minimum: 0 },
        Qualifications: { type: "string", minLength: 1 },
        education: { type: "string", enum: ["High School", "Bachelor", "Master", "PhD"] }
    },
    required: ["FullName", "Email", "PhoneNumber", "Qualifications", "education"]
};

document.getElementById("profileForm").addEventListener("submit", function (e) {
    const formData = {
        FullName: document.getElementById("FullName").value.trim(),
        Email: document.getElementById("Email").value.trim(),
        PhoneNumber: document.getElementById("PhoneNumber").value.trim(),
        experience: parseFloat(document.getElementById("experience").value) || 0,
        Qualifications: document.getElementById("Qualifications").value.trim(),
        education: document.getElementById("education").value
    };

    const ajv = new Ajv();
    const validate = ajv.compile(schema);

    if (!validate(formData)) {
        e.preventDefault();
        alert("Please correct the errors:\n" + validate.errors.map(err => `${err.instancePath.replace("/", "") || err.params.missingProperty}: ${err.message}`).join("\n"));
    }
});
</script>
</body>
</html>
