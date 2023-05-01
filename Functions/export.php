<?php

// establish a connection to the MySQL database
$conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

// check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$data = "SELECT * FROM attendance ORDER BY id ASC";
$query = $conn->query($data);

if($query->num_rows > 0){
    $delimeter = ",";
    $filename = "attendance-data_". date('Y-m-d') .".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('ID', 'NAME', 'EMPLOYEE ID', 'DATE', 'TIME IN', 'STATUS', 'TIME OUT', 'NUMBER OF HOUR', 'OVER TIME', 'SCHEDULE');
    fputcsv($f , $fields, $delimeter);

    while($row = $query->fetch_assoc()){
        $linedata = array($row['id'], $row['Name'], $row['employee_id'], $row['date'], $row['time_in'], $row['status'], $row['time_out'], $row['num_hr'], $row['over_time'], $row['schedule_id']);
        fputcsv($f , $linedata, $delimeter);
    }

    fseek($f, 0);

    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}

$datadelete = "SELECT * FROM attendance";
$querydel = $conn->query($datadelete);
if($querydel->num_rows > 0){
    while($row1 = $querydel->fetch_assoc()){
        $delete = "DELETE FROM attendance WHERE attendance.id = '".$row1['id']."'";
        $querydell = $conn->query($delete);
    }
}