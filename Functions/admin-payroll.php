<?php
if(isset($_POST['submit'])){
    require '../Classes/database.php';
    require '../Classes/admin.php';

    $database = new Database();
    $payroll = new Payroll($database);

    $type = '';

    if (isset($_POST["type2"])) {
    $type = trim($_POST["type2"]);
    }


     if(isset($_POST["type"]) && $_POST["type"] !== "custom") {
    $type = trim($_POST["type"]);
    }

    

    $prlist = array(
        // 'date' => trim($_POST["date"]),
        'code' => trim($_POST["code"]),
        'start' => isset($_POST["start"]) ? trim($_POST["start"]) : 0,
        'end' => isset($_POST["end"]) ? trim($_POST["end"]) : 0,
        'type' => $type
    );


    $payroll->Insertpayroll($prlist);
    header("Location: ../admin/prlist.php?status=created");

}
?>