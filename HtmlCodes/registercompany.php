<!DOCTYPE HTML>  
<html>

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">  
      <title> Register with us </title>
      <link rel="stylesheet" type="text/css" href="css/register.css?v=1.1">
      <style>
        /* Header styles */
        header {
            background-color: #06344e95;
            padding: 4px 5px;
            width: 100%; 
            text-align: center;
            color: white;
            top: 0;
            font-size: 16px;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to your recruitment platform</h1>
</header>

  </head>

<body>  

<?php
// define variables and set to empty values
$CompanyName = $Description = $StartDate = $Address = $ContactNumber = $Email= $Website = "";
$CompanyNameErr = $DescriptionErr = $StartDateErr = $AddressErr = $ContactNumberErr = $EmailErr = $WebsiteErr = "";

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
  


    //Company Name Validation
    if (empty($_POST["CompanyName"])){
      $CompanyNameErr= "Required Field";
      $Valid= false ;

    }
    else{
      $CompanyName = test_input($_POST["CompanyName"]);

    }

  
    //Company Description Validation
     if (empty($_POST["Description"])) {
        $DescriptionErr = "Description is required";
        $Valid = false;
      } 
      else {
        $Description = test_input($_POST["Description"]);
        //$wordCount = str_word_count($Description);
       /* if ($wordCount < 100) {
            $DescriptionErr = "Profile must contain at least 100 words (currently $wordCount words)";
            $Valid = false;
        }
            */
      }
  


    //Established on Validation
    if (empty($_POST["StartDate"])){
      $StartDate="Required Field";
      $Valid= false ;

    }
    else {

      $StartDate = test_input($_POST["StartDate"]);
      $currentdate= date ("d-m-Y");

      //Checking if the provided date is today or in the future
      if  (strtotime($StartDate) >= strtotime($currentdate)){
        $StartDateErr = "Error";
        $Valid = false;
      }
    }


    //Address Validatiom
    if (empty($_POST["Address"])) {
        $AddressErr = "Address is required";
        $Valid = false;
      } 
      else {
        $Address = test_input($_POST["Address"]);
      }



    //Contact Number Validation

    if (empty($_POST["ContactNumber"])){
      $ContactNumberErr= "Contact Number is required  ";
      $Valid= false;
    }

    elseif (!preg_match("/^\d{8,15}$/", $_POST["ContactNumber"])) {
      $ContactNumberErr = "Invalid Contact Number format";
      $Valid = false;
    }

    else {
      $ContactNumber = test_input($_POST["ContactNumber"]);
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


    //Website Validation
    if (empty($_POST["Website"])) {
        $WebsiteErr = "Website is required";
        $Valid = false;
    } else {
        $Website = test_input($_POST["Website"]);

        if (!preg_match("/^www\.\S+\.\S+$/", $Website)) {
            $WebsiteErr = "Website must start with 'www.' and follow the format www.example.com";
            $Valid = false;
        }
    }
   


  if ($Valid) {
    $sql = "INSERT INTO employer (CompanyName, Description, StartDate,  Address, ContactNumber,Email, Website)
            VALUES ('$CompanyName', '$Description', '$StartDate', '$Address','$ContactNumber' , '$Email', '$Website')";

    if ($conn->query($sql) === TRUE) {
        header("Location: thankyoupage.php");
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
      margin: 10 auto;  ">Register With Us</h1>
  
  
  
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  
    Company Name: <input type="text" name="CompanyName" value="<?php echo isset($CompanyName) ? $CompanyName : ''; ?>">
    <span style="font-size:0.75em;color:red;"><?php echo $CompanyNameErr; ?></span>
    <br><br>
  
    Description : <textarea name="Description" rows="6" cols="60"><?php echo isset($Description) ? $Description : ''; ?></textarea>
    <span style="font-size:0.75em;color:red;"><?php echo $DescriptionErr; ?></span>
    <br><br>

    StartDate : <input type="date" name="StartDate" value="<?php echo isset($StartDate) ? $StartDate : ''; ?>">
    <span style="font-size:0.75em;color:red;"><?php echo $StartDateErr; ?></span>
    <br><br>

    Address: <input type="text" name="Address" value="<?php echo isset($Address) ? $Address : ''; ?>">
    <span style="font-size:0.75em;color:red;"><?php echo $AddressErr; ?></span>
    <br><br>
  
    Contact Number : <input type="number" name="ContactNumber" value="<?php echo isset($ContactNumber) ? $ContactNumber: ''; ?>">
    <span style="font-size:0.75em;color:red;"><?php echo $ContactNumberErr; ?></span>
    <br><br>

    Email : <input type="text" name="Email" value="<?php echo isset($Email) ? $Email : ''; ?>">
    <span style="font-size:0.75em;color:red;"><?php echo $EmailErr; ?></span>
    <br><br>

    Website: <input type="text" name="Website"value="<?php echo isset($Website) ? $Website : ''; ?>">
    <span style="font-size:0.75em;color:red;"><?php echo $WebsiteErr; ?></span>
    <br><br>
   
    <input type="submit" name="submit" value="Submit">  
  </form>
  
  
  
  </body>
  </html>