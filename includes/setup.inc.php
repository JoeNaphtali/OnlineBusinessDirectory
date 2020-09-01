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

$sql = "CREATE DATABASE online_business_directory";
//Display success message if database was created
if ($conn->query($sql)==TRUE) {
    echo "Database created successfully | ";
}
//Display error message if database was not created
else {
    echo "There was an error creating the database: ". $conn->error;
}
mysqli_select_db($conn, "online_business_directory");

//CREATE USER TABLE

$sql = "CREATE TABLE user(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    profile_picture BOOLEAN NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    bio TEXT,
    facebook VARCHAR(255),
    twitter VARCHAR(255),
    instagram VARCHAR(255),
    linkedin VARCHAR(255)
    )";
//Display success message if user table in created
if($conn->query($sql)===TRUE) {
    echo "The 'user' table was created succesfully | ";
}
//Display error message if user table is not created
else {
    echo "There was an error creating the 'user' table: ".$conn->error;
}

// CREATE PROFILE IMAGE TABLE

$sql = "CREATE TABLE profileimg (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    status INT(11) NOT NULL
    )";
//Display success message if profileimg table in created
if($conn->query($sql)===TRUE) {
    echo "The 'profileimg' table created succesfully";
}
//Display error message if profileimg table is not created
else {
    echo "There was an error creating the 'profileimg' table: ".$conn->error;
}

?>



