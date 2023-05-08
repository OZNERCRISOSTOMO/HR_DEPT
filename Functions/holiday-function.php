<?php
    $dbServername = "sql985.main-hosting.eu";
    $dbUsername = "u839345553_sbit3g";
    $dbPassword = "sbit3gQCU";

    $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

$holiday = $_POST['hname'];
$hdate = $_POST['hdate'];
$hpercent = $_POST['hpercent'];

if($hpercent == "Regular Holiday"){
    $value = 2;
}else if($hpercent == "Special Non-Working Holiday"){
    $value = 1.30;
}

if(isset($_POST['hsubmit'])){
    $h_data = "SELECT * FROM holiday WHERE holiday_date = '$hdate'";
    $h_query = $conn->query($h_data);

    if($h_query->num_rows > 0){
        echo 'Input';
    }else{
        $h_insert = "INSERT INTO holiday (holiday_name, holiday_date, percentage) VALUES ('$holiday', '$hdate', '$value')";
        $h_insert_query = $conn->query($h_insert);

        if($h_insert_query){
            $h_select = "SELECT * FROM attendance WHERE date = '$hdate'";
            $h_select_query = $conn->query($h_select);
           

            while($row = mysqli_fetch_assoc($h_select_query)){

             $h_update = "UPDATE attendance SET num_hr = num_hr*$hpercent WHERE id = '".$row['id']."'";
             $double_pay = $conn->query($h_update);
            }

            header("Location: ../Pages/dashboard.php?success=nyenye");
        }
    }
}