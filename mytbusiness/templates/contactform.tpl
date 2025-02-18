<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get in touch with us</title>
    <link rel="stylesheet" text="text/css" href="css/contactform.css?v=1.1"> 
</head>
<body>
    <div class="contact-form-container">
        <h1>Get in touch with us</h1>
        
    
        <form action="submit_form.php" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="companyName">Company Name*</label>
                    <input type="text" id="companyName" name="companyName" required>
                </div>
                <div class="form-group">
					<label for="Name">Name*</label>
					<input type="text" id="Name" name="Name" required>						
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
					<label for="email">Email*</label>
					<input type="email" id="email" name="email" required>
                </div>

				<div class="form-group">
                    <label for="contactNumber">Contact number*</label>
                    <input type="tel" id="contactNumber" name="contactNumber" required>
                </div>
                
            </div>

            <div class="form-row">               
                <div class="form-group">
                    <label for="enquiry">Your Enquiry*</label>
                    <textarea id="enquiry" name="enquiry" rows="3"></textarea>
                </div>			
            </div>


            
            <div class="form-footer">
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>

    
</body>