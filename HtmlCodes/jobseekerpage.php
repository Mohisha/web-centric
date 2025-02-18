<!DOCTYPE HTML>  
<html>

  <head>
      <meta charset="UTF-8">
      <title> JobQuest </title>
       <!-- Link the CSS file -->
      <link rel="stylesheet" type="text/css" href="css/jobseeker.css?v=1.1">
  </head>

<body>  

<?php
// define variables and set to empty values
$FirstName = $LastName = $DateOfBirth = $PhoneNumber = $Gender = $Address = $Email= $Profile = "";
$FirstNameErr = $LastNameErr=$DateOfBirthErr = $PhoneNumberErr = $GenderErr = $AddressErr = $EmailErr = $ProfileErr= "";

$errors=[];
$Valid=  true ;



// Database connection variables
$servername = "localhost";  // or your database server
$username = "root";         // your database username
$password = "";             // your database password
$dbname = "jobrecruitment"; // the name of your database

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  


    //FirstName Validation
    if (empty($_POST["FirstName"])){
      $FirstNameErr= "Required Field";
      $Valid= false ;

    }
    else{
      $FirstName = test_input($_POST["FirstName"]);

    }

  
    //LastName Validation
    if (empty($_POST["LastName"])){
      $LastNameErr= "*Required Field";
      $Valid= false ;

    }
    else{
      $LastName = test_input($_POST["LastName"]);

    }



    //DateOfBirth Validation
    if (empty($_POST["DateOfBirth"])){
      $DateOfBirthErr="Required Field";
      $Valid= false ;

    }
    else {

      $DateOfBirth = test_input($_POST["DateOfBirth"]);
      $currentdate= date ("d-m-Y");

      //Checking if the provided date is today or in the future
      if  (strtotime($DateOfBirth) >= strtotime($currentdate)){
        $DateOfBirthErr = "Error";
        $Valid = false;
      }
    }


    //PhoneNumber Validation

    if (empty($_POST["PhoneNumber"])){
      $PhoneNumberErr= "Phone Number is required  ";
      $Valid= false;
    }

    elseif (!preg_match("/^\d{8,15}$/", $_POST["PhoneNumber"])) {
      $PhoneNumberErr = "Invalid Phone Number format";
      $Valid = false;
    }

    else {
      $PhoneNumber = test_input($_POST["PhoneNumber"]);
    }



    //Gender Validation

    if (empty($_POST["Gender"])) {
      $GenderErr = "Gender is required";
      $Valid = false;
    } 
    else {
      $Gender = test_input($_POST["Gender"]);
    }
    


    //Address Validatiom
    if (empty($_POST["Address"])) {
      $AddressErr = "Address is required";
      $Valid = false;
    } 
    else {
      $Address = test_input($_POST["Address"]);
    }
  


    //Email Validation
    if (empty($_POST["Email"])) {
      $EmailErr = "Email is required";
      $Valid = false;
    } 
    elseif (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL) || !preg_match("/@.*\.com$/", $_POST["Email"])) {
      $EmailErr = "Invalid Email format, must contain '@' and end with '.com'";
      $Valid = false;
    } 
    else {
      $Email = test_input($_POST["Email"]);
    }


    //Profile Validation (Minimum 100 words)
    if (empty($_POST["Profile"])) {
      $ProfileErr = "Profile is required";
      $Valid = false;
    } 
    else {
      $Profile = test_input($_POST["Profile"]);
      $wordCount = str_word_count($Profile);
      if ($wordCount < 100) {
          $ProfileErr = "Profile must contain at least 100 words (currently $wordCount words)";
          $Valid = false;
      }
    }

  


  if ($Valid) {
    $sql = "INSERT INTO jobseeker (FirstName, LastName, DateOfBirth, PhoneNumber, Gender, Address, Email, Profile)
            VALUES ('$FirstName', '$LastName', '$DateOfBirth', '$PhoneNumber', '$Gender', '$Address', '$Email', '$Profile')";

    if ($conn->query($sql) === TRUE) {
        header("Location: thankyoupage.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }

}




// Close the database connection
$conn->close();



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1 style="color: darkblue; color: var(--blue);text-align: center;font-family: 'Noto Sans JP', serif;
    font-size: 2.5rem;
    margin: 10 auto;  ">Job Application Form</h1>




<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  First Name: <input type="text" name="FirstName" value="<?php echo isset($FirstName) ? $FirstName : ''; ?>">
  <span style="font-size:0.75em;color:red;"><?php echo $FirstNameErr; ?></span>
  <br><br>


  Last Name: <input type="text" name="LastName"value="<?php echo isset($LastName) ? $LastName : ''; ?>">
  <span style="font-size:0.75em;color:red;"><?php echo $LastNameErr; ?></span>
  <br><br>


  Date of Birth: <input type="date" name="DateOfBirth" value="<?php echo isset($DateOfBirth) ? $DateOfBirth : ''; ?>">
  <span style="font-size:0.75em;color:red;"><?php echo $DateOfBirthErr; ?></span>
  <br><br>


  Phone Number : <input type="number" name="PhoneNumber" value="<?php echo isset($PhoneNumber) ? $PhoneNumber : ''; ?>">
  <span style="font-size:0.75em;color:red;"><?php echo $PhoneNumberErr; ?></span>
  <br><br>


  Gender:
  <input type="radio" name="Gender" value="female" <?php if(isset($Gender) && $Gender == "female") echo "checked"; ?>>Female
  <input type="radio" name="Gender" value="male" <?php if(isset($Gender) && $Gender == "male") echo "checked"; ?>>Male
  <input type="radio" name="Gender" value="other" <?php if(isset($Gender) && $Gender == "other") echo "checked"; ?>>Other
 
  <span style="font-size:0.75em;color:red;"><?php echo $GenderErr; ?></span>
  <br><br>


  Address: <input type="text" name="Address" value="<?php echo isset($Address) ? $Address : ''; ?>">
  <span style="font-size:0.75em;color:red;"><?php echo $AddressErr; ?></span>
  <br><br>


  Email : <input type="text" name="Email" value="<?php echo isset($Email) ? $Email : ''; ?>">
  <span style="font-size:0.75em;color:red;"><?php echo $EmailErr; ?></span>
  <br><br>


  Profile: <textarea name="Profile" rows="5" cols="40"><?php echo isset($Profile) ? $Profile : ''; ?></textarea>
  <span style="font-size:0.75em;color:red;"><?php echo $ProfileErr; ?></span>
  <br><br>
 
  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>