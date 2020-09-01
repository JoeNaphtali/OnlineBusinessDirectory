<?php

//INITIATE VARIABLES

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "online_business_directory";

//DATABASE CONNECTION

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//DISPLAY ERROR IF DATABSE CONNECTION FAILS

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

?>