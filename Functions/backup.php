<?php
// $timezone = 'Asia/Manila';
// date_default_timezone_set($timezone);
// // Database credentials
// $db_host = 'sql985.main-hosting.eu';
// $db_user = 'u839345553_sbit3g';
// $db_pass = 'sbit3gQCU';
// $db_name = 'u839345553_SBIT3G';


// header("Location: ../Pages/dashboard.php?value=backup");

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'activity';

// // Set the name of the file to export
// $filename = 'database_export_' . date('Y-m-d') . '.sql';

// // Execute mysqldump command to create a backup of the database
// $command = "mysqldump --host=$db_host --user=$db_username --password=$db_password --no-create-db --complete-insert --skip-lock-tables $db_name > $filename";
// exec($command, $output, $return_var);

// if ($return_var !== 0) {
//     // An error occurred while executing the command
//     echo "Error: mysqldump command failed with return code $return_var<br>";
//     echo "Output: <pre>" . implode("\n", $output) . "</pre>";
//     exit;
// }

// // Download the backup file
// header('Content-Description: File Transfer');
// header('Content-Type: application/octet-stream');
// header('Content-Disposition: attachment; filename=' . basename($filename));
// header('Content-Transfer-Encoding: binary');
// header('Content-Length: ' . filesize($filename));
// readfile($filename);

// // Delete the backup file
// unlink($filename);

mysqldump -host=$db_host user=$db_username password=$db_password --no-create-db --complete-insert --skip-lock-tables $db_name > $filename;


?>