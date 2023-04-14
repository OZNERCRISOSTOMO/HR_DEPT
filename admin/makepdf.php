<?php
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);



$fname = $_POST['employee-name'];
$position = $_POST['position'];
$branch = $_POST['branch'];
$date = $_POST['date-from'];
$date1 = $_POST['date-to'];
$present = $_POST['present'];
$overtime = $_POST['overtime'];
$salary = $_POST['salary'];
$prlistid = $_POST['prlist-id'];

$sss = $_POST['sss'];
$philhealth = $_POST['philhealth'];
$pagibig = $_POST['pagibig'];



isset($_POST['sss']);

if (filter_has_var(INPUT_POST, 'sss')) {
        $num1 = $_POST['salary'];       
        $sss_result = $num1 * 0.045;
}
else {
        $sss_result = '0 - not a member';
}

if (filter_has_var(INPUT_POST, 'philhealth')) {
        $num1 = $_POST['salary'];
        $phil_result = $num1 * 0.045;
}
else {
        $phil_result = '0 - not a member';
}

if (filter_has_var(INPUT_POST, 'pagibig')) {
        $num1 = $_POST['salary'];

        if ($num1 <= 1499){
            $love_result = $num1 * 0.02;
            }
        else if ($num1 >= 1500 || $num1 <= 4999){
            $love_result = $num1 * 0.02;
        }
        else if ($num1 >= 5000) {
            $love_result = $num1 * 0.03;
        }
        else {
            'error';
        }
}
else {
        $love_result = '0 - not a member';
}



$networth = $salary - ($sss_result + $phil_result + $love_result);


if ($admin->checkprlist($prlistid)) {
    $admin->insertEmployeePayslipForm($fname, $position, $branch, $date, $date1, $present, $overtime, $salary, $prlistid, $sss, $philhealth, $pagibig);
    $admin->insertEmployeePayslip($fname, $networth, $prlistid);
}


?>