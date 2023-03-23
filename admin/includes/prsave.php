<?php
if(isset($_POST['submit'])){
    require '../Classes/database.php';
    require '../Classes/admin.php';

    $database = new Database();
    $prlist = new Insertpayroll($database);

    $prlist = array(
        'date' => trim($_POST["date"]),
        'code' => trim($_POST["code"]),
        'start' => trim($_POST["start"]),
        'end' => trim($_POST["end"]),
        'type' => trim($_POST["type"]),
    );
}
?>