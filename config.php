<?php

$dbServer = "localhost";
$dbUsername = "root";
$bdPassword = "Rodri354#";
$dbName = "cs4301";

$conn = mysqli_connect($dbServer, $dbUsername, $bdPassword, $dbName);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


?>