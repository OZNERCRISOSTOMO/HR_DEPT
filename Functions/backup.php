<?php
$timezone = 'Asia/Manila';
date_default_timezone_set($timezone);
// Database credentials
$db_host = 'sql985.main-hosting.eu';
$db_user = 'u839345553_sbit3g';
$db_pass = 'sbit3gQCU';
$db_name = 'u839345553_SBIT3G';

// Name of the file to save the backup as
$file = "../backups/";
$backup_file = "".$db_name."_". date('m') .".sql";

// Command to create the backup using mysqldump
$command = "mysqldump --opt -h $db_host -u $db_user -p$db_pass $db_name > $file/$backup_file";

// Execute the command using the exec() function
exec($command);

header("Location: ../Pages/dashboard.php?value=backup");
?>