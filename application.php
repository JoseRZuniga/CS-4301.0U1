<?php
// Include config file
require_once "config.php";
 
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
    

    // Check if address is empty 
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
    

    // Validate 
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";     
    } elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $email_err = "Email must inlcude @ and .edu";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){
        
    // Prepare an insert statement
    $sql = "INSERT INTO students (firstname, lastname, email, passwd) VALUES (?, ?, ?, ?)";
     
    if($stmt = mysqli_prepare($conn, $sql)){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $param_password);
                
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            // Redirect to login page
            header("location: includes/home.html");
        } else{
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($conn);

function isDate($string) {
    $matches = array();
    $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
    if (!preg_match($pattern, $string, $matches)) return false;
    if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
    return true;
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Eriksson School of Engineering Application</h2>
        <p>Please fill the following form.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                <span class="help-block"><?php echo $firstname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                <span class="help-block"><?php echo $lastname_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($satScore_err)) ? 'has-error' : ''; ?>">
                <label>Sat Score</label>
                <input type="text" name="satScore" class="form-control" value="<?php echo $satScore; ?>">
                <span class="help-block"><?php echo $satScore_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($gpa_err)) ? 'has-error' : ''; ?>">
                <label>GPA</label>
                <input type="text" name="gpa" class="form-control" value="<?php echo $gpa; ?>">
                <span class="help-block"><?php echo $gpa_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($birthday_err)) ? 'has-error' : ''; ?>">
                <label>Birth date</label>
                <input type="text" name="birthday" class="form-control" value="<?php echo $birthday; ?>">
                <span class="help-block"><?php echo $birthday_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($zipcode_err)) ? 'has-error' : ''; ?>">
                <label>Zipcode</label>
                <input type="text" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>">
                <span class="help-block"><?php echo $zipcode_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>