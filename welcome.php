<?php
// Initialize the session
session_start();

// Required files
require_once "config.php";
require_ONCE  "logged.php";

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
</head>
<body>
    
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["email"]); ?></b>. Welcome to our site.</h1>
    </div>
    <div>
        <h2>Apply for the Erik Jonsson School of Engineering</h2>
    </div>
        <div style="text-align: center;">
                <h2 style="text-align: center;">Eriksson School of Engineering Application</h2>
                <p style="text-align: center;">Please fill the following form.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                        <label>First Name</label>
                        <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                        <span class="help-block"><?php echo $firstname_err; ?></span>
                        <br></br>
                    </div>
                    <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                        <label>Last Name</label>
                        <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                        <span class="help-block"><?php echo $lastname_err; ?></span>
                        <br></br>
                    </div>   
                    <div class="form-group <?php echo (!empty($satScore_err)) ? 'has-error' : ''; ?>">
                        <label>Sat Score</label>
                        <input type="text" name="satScore" class="form-control" value="<?php echo $satScore; ?>">
                        <span class="help-block"><?php echo $satScore_err; ?></span>
                        <br></br>
                    </div>
                    <div class="form-group <?php echo (!empty($gpa_err)) ? 'has-error' : ''; ?>">
                        <label>GPA</label>
                        <input type="text" name="gpa" class="form-control" value="<?php echo $gpa; ?>">
                        <span class="help-block"><?php echo $gpa_err; ?></span>
                        <br></br>
                    </div>
                    <div class="form-group <?php echo (!empty($birthday_err)) ? 'has-error' : ''; ?>">
                        <label>Birth date</label>
                        <input type="text" name="birthday" class="form-control" value="<?php echo $birthday; ?>">
                        <span class="help-block"><?php echo $birthday_err; ?></span>
                        <br></br>
                    </div>
                    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                        <span class="help-block"><?php echo $address_err; ?></span>
                        <br></br>
                    </div>
                    <div class="form-group <?php echo (!empty($zipcode_err)) ? 'has-error' : ''; ?>">
                        <label>Zipcode</label>
                        <input type="text" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>">
                        <span class="help-block"><?php echo $zipcode_err; ?></span>
                        <br></br>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                    </div>
                </form>
            </div> 
        </div>
    </div>
    <div>
        <br>
    <p style="text-align: center;">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <p style="text-align: center;">Already applied? <a href="admission.php?variable1=$satScore&variable2=$gpa">Click for Webpage here</a>.</p>
</div>
</body>
</html>