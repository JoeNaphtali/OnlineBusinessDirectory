<?php

// Database Connection
require 'dbh.inc.php';

$logFile = "time.log";
$timeSpent = $_POST['timeSpent'];
$listing_id = $_POST['listing_id'];
file_put_contents($logFile, $timeSpent);
echo $timeSpent.", ".$listing_id;

$sql="UPDATE analytics SET total_visit_time = total_visit_time + $timeSpent WHERE listing_id = 1";
mysqli_query($conn, $sql);

?>