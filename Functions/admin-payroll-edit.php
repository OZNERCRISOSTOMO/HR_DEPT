<?php
session_start();
if (isset($_SESSION['admin_id']) ) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payroll = new Payroll($database);

    if (isset($_POST['editSubmit'])) {
        $id = $_POST['editId'];
        $code = $_POST['editCode'];
        $start = $_POST['editStart'];
        $end = $_POST['editEnd'];
        $type = $_POST['editType'];

        // echo $id;
        // echo "</br>";
        // echo $code;
        // echo "</br>";
        // echo $start;
        // echo "</br>";
        // echo $end;
        // echo "</br>";
        // echo $type;
    
        $payroll->updatePayroll($id, $code, $start, $end, $type);
     
    }
} else {
    header("Location: ../admin/prlist.php");
}
?>
