<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "uniform";  // Corrected to ensure it matches the variable used in mysqli_connect

// Connect to the database
$con = mysqli_connect($host, $user, $pass, $db);

if ($con) {
    echo "";
} else {
    echo "DB Not Connected: " . mysqli_connect_error();
}
?>
