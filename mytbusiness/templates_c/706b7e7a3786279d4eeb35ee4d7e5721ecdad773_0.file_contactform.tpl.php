<?php
/* Smarty version 5.4.1, created on 2024-12-20 06:28:17
  from 'file:contactform.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.1',
  'unifunc' => 'content_676500711c2766_12857199',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '706b7e7a3786279d4eeb35ee4d7e5721ecdad773' => 
    array (
      0 => 'contactform.tpl',
      1 => 1734672491,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_676500711c2766_12857199 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\mytbusiness\\templates';
?><!DOCTYPE html>
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

    
</body><?php }
}
