<?php

    require '../Classes/admin.php';
    require '../Classes/database.php';
    
    $database = new Database();
    $admin = new Admin($database);
$dbServername = "sql985.main-hosting.eu";
$dbUsername = "u839345553_sbit3g";
$dbPassword = "sbit3gQCU";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['deleteid'])) {
    $id = $_POST['deleteid'];
    $overtime1 = "SELECT * FROM `leave` WHERE id = $id";
    $queryko = $conn->query($overtime1);
    $date = $queryko->fetch_assoc();

    if (isset($_POST['deletebtn'])) {
        $query = "DELETE FROM `leave` WHERE id = '$id'";
        $conn->query($query);
        $date_end = $date['date_ended'];
        $date_start = $date['date_started'];
        header("Location: ../Pages/Leave.php?success=deleted");

        $email = "SELECT employees.*,employee_details.position FROM employees JOIN employee_details ON employees.id = employee_details.employee_id WHERE employees.id = '".$date['employee_id']."'";
        $email_query = $conn->query($email);
        $email_row = $email_query->fetch_assoc();


        $message = "Dear Employee,

We are sorry to inform you that your request for a vacation leave from ".$date_start." to ".$date_end." has been denied. Unfortunately, we cannot accommodate your request due to the workload and scheduling conflicts during that time.

We understand that this may cause inconvenience for you, and we apologize for any disruption this may cause to your plans. However, please know that we value your contribution to the company and appreciate your understanding in this matter.

If you have any questions or concerns, please feel free to discuss them with your supervisor or HR representative. We hope that you will be able to plan your vacation at another time that will not conflict with our operations.

Best regards,
Human Resource Department";

$database->sendEmail($email_row['email'],$date['Type']." Declined",$message);
    }
}