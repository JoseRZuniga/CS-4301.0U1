<?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


// Function to match mm/dd/yyyy format
function isDate($string) {
    $matches = array();
    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
    return true;
} 

// Function to match d.dd format
function isGPA($string){
    $matches = array();
    $pattern = '/^[0-4]\.\d{2}$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    return true;
}
 
$firstname = $lastname = $satScore = $gpa = $birthday = $address = $zipcode = "";
$firstname_err = $lastname_err = $satScore_err = $gpa_err = $birthday_err = $address_err = $zipcode_err = "";
 


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Please enter your first name.";
    } elseif(!ctype_alpha(trim($_POST["firstname"]))){
        $firstname_err = "First Name must be alphabetical";
    } else{
        $firstname = trim($_POST["firstname"]);
    }

    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Please enter your last name.";
    } elseif(!ctype_alpha(trim($_POST["lastname"]))){
        $lastname_err = "Last Name must be alphabetical";
    } else{
        $lastname = trim($_POST["lastname"]);
    }
    
    // Validate SAT Score
    if(empty(trim($_POST["satScore"]))){
        $satScore_err = "Please enter your SAT Score.";     
    } elseif(!ctype_digit(trim($_POST["satScore"]))){
        $satScore_err = "SAT Score must be a digit";
    } else{
        $satScore = trim($_POST["satScore"]);
    }

     // Validate GPA
     if(empty(trim($_POST["gpa"]))){
        $gpa_err = "Please enter your GPA (Format: d.dd).";     
    } elseif(!isGPA(trim($_POST["gpa"]))){
        $gpa_err = "GPA must be formatted d.dd";
    } else{
        $gpa = trim($_POST["gpa"]);
    }

     // Validate Birthdate
     if(empty(trim($_POST["birthday"]))){
        $birthday_err = "Please enter your birth date (Format: mm/dd/yyyy).";     
    } elseif(!isDate(trim($_POST["birthday"]))){
        $birthday_err = "Birth date must be formatted mm/dd/yyyy";
    } else{
        $birthday = trim($_POST["birthday"]);
    }

     // Validate Address
     if(empty(trim($_POST["address"]))){
        $address_err = "Please enter your address.";     
    } else{
        $address = trim($_POST["address"]);
    }

    // Validate Zipcode
    if(empty(trim($_POST["zipcode"]))){
        $zipcode_err = "Please enter your zipcode.";     
    } elseif(!ctype_digit(trim($_POST["zipcode"]))){
        $zipcode_err = "Zipcode must be a digit";
    } else{
        $zipcode = trim($_POST["zipcode"]);
    }
    

    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($satScore_err) && empty($gpa_err) && empty($birthday_err) && empty($address_err) && empty($zipcode_err)){
        
    $sql = "INSERT INTO students (Firstname, Lastname, SatScore, GPA, Birthday, Address, Zipcode) VALUES (?, ?, ?, ?, ?, ? ,?)";
     
    if($stmt = mysqli_prepare($conn, $sql)){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $satScore, $gpa, $birthday, $address, $zipcode);

        session_start();
        $_SESSION["sat"] = $satScore;
        $_SESSION["gpa"] = $gpa;  
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            header("location: admission.php");
        } else{
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    }
}


?>