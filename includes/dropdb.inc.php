<?php

//INITIATE VARIABLES

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";

//CREATE DATABASE CONNECTION

$conn = mysqli_connect($servername, $dBUsername, $dBPassword);

if (!$conn) {
    //If database connection fails, display error
    die("Connection failed: ".mysqli_connect_error());
}

//CREATE DATABASE

$sql = "DROP DATABASE online_business_directory";
//Display success message if database was created
if ($conn->query($sql)==TRUE) {
    echo "The database 'online_business_directory' was deleted successfully.";
}
//Display error message if database was not created
else {
    echo "There was an error deleting the database: ". $conn->error;
}

// Close connection string
mysqli_close($conn);