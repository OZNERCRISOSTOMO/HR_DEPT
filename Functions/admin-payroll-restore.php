<?php
$dbServername = "sql985.main-hosting.eu";
$dbUsername = "u839345553_sbit3g";
$dbPassword = "sbit3gQCU";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$empid = $_GET['id'];
    $updateStat = "UPDATE prlist SET Status = '1'  WHERE id='$empid'";
    $updateQuery = $conn->query($updateStat);

    header("Location: ../admin/prlist.php");

?>