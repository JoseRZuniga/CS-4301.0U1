<?php
// Include config file
require_once "config.php";


$firstname = $lastname = "";
$firstname_err = $lastname_err = "";
 
if(isset($_POST['click1'])){
 
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

    $sql = "SELECT COUNT(*) as num, StudentID FROM students WHERE Firstname = $firstname and Lastname = $lastname";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Accepted";
    }
    } else {
        echo "Denied";
    }

}

if(isset($_POST['click2'])){
    // The number of student that applied for the program
    $sql = "SELECT COUNT(*) as num, StudentID FROM students";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo " Number of students that applied: " . $row["num"]. "<br>";
    }
    } else {
        echo "0 results";
    }

    // The number of student that got accepted 
    $sql = "SELECT COUNT(*) as studID, StudentID FROM students WHERE GPA > 3.20 and SATScore > 1200";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo " Number of students that got accepted: " . $row["studID"]. "<br>";
    }
    } else {
        echo "0 results";
    }

    // The number of student that got accepted 
    $sql = "SELECT COUNT(*) as studID FROM students WHERE Birthday > '01/01/2000'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo " Number of students that are older than 20: " . $row["studID"]. "<br>";
    }
    } else {
        echo "0 results";
    }

    // The average GPA for the admitted students 
    $sql = "SELECT AVG(GPA) as aver FROM cs4301.students WHERE GPA > 3.20 and SATScore > 1200;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  "Average GPA of accepted students: " . $row["aver"]. "<br>";
    }
    } else {
        echo "0 results";
    }

    // The number of admitted students in each zip code 
    $sql = "SELECT COUNT(*) as num, Zipcode FROM cs4301.students WHERE GPA > 3.20 and SATScore > 1200 group by Zipcode ";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo  $row["num"]. " students got accepted from zipcode: " . $row["Zipcode"]. "<br>";
    }
    } else {
        echo "0 results";
    }

    // The number of students that their GPA are greater than 3.8 and SAT SCORE greater than 1400. 
    $sql = "SELECT COUNT(*) as studID, StudentID FROM students WHERE GPA > 3.8 and SATScore > 1400";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo " Number of students with a GPA > 3.8 and SAT > 1400: " . $row["studID"]. "<br>";
    }
    } else {
        echo "0 results";
    }
}


mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <script>
        var d = new Date();
        document.getElementById("date").innerHTML = d;

    </script>
    </head>
    <title>Admission</title>
    <body>
        <p id="date"></p>
        <a href="logout.php">Sign Out of Your Account</a>
        </p>
        <div  class="jumbotron text-center" style="background-color: aliceblue;">
        <h1 style="font: arial;">Admission</h1>
        <h2>
            <ul>
                <a href="home.html">Home</a>
                <a href="faculty.html">Faculty</a>
                <a href="students.html">Students</a>
                <a href="admission.php">Admission</a>
                <a href="contact.html">Contact</a>
                <a href="research.html">Research</a>
              </ul>
        </h2>
        </div>
        <div class="lside">
        </div>
        <!--Created a 2 columns with bootstrap-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Check Application Status</h3>
                        <form  method="post">
                                <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                                    <label>Please input First Name:</label>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                                    <span class="help-block"><?php echo $firstname_err; ?></span>
                                    <br></br>
                                </div>
                                <div class="form-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                                    <label>Please input Last Name</label>
                                    <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
                                    <span class="help-block"><?php echo $lastname_err; ?></span>
                                    <br></br>
                                </div> 
                            <input type="submit"  value="Check" name="click1">
                        </div>
                        <h3>Check Application Statistics</h3>
                        <form method="post">
                        <input type="submit"  value="Check" name="click2">
                        </form>
            </div>
        </div>
    </div>


        </div>
        </div>  
        <div class="rside">
        </div>
        <div class="footer">Jose Rodriguez JPR160230</div>        
    </body>
</html>