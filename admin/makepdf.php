<?php
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);


if(isset($_POST["submit-create"])){
        
$fname = $_POST['employee-name'];
$position = $_POST['position'];
$branch = $_POST['branch'];
$department = $_POST['department'];
$date = $_POST['date-from'];
$date1 = $_POST['date-to'];
$present = $_POST['present'];
$overtime = $_POST['overtime'];
$ratePerHour = $_POST['salary'];
$prlistid = $_POST['prlist-id'];
$employeeId = $_POST['employee-id'];
$food_allowance = $_POST['food-allowance'];
$transpo_allowance = $_POST['transpo-allowance'];
$prlistType = $_POST["prslist-type"];


$totalAllowance = $food_allowance + $transpo_allowance;
$salary = $ratePerHour * ($present + $overtime);

$sss = "";
$philhealth = "";
$pagibig = "";

 $sssChecked = isset($_POST['sss']) ? 1 : 0;
      $philhealthChecked  = isset($_POST['philhealth']) ? 1 : 0;
      $pagibigChecked = isset($_POST['pagibig']) ? 1 : 0;

//check if sss is checked 
if(isset($_POST['sss'])){
        $sss = $_POST['sss'];
      }else{
        $sss = null;
      }
      
      //check if philhealth is checked 
      if(isset($_POST['philhealth'])){
       $philhealth = $_POST['philhealth'];
      }else{
        $philhealth = null;
      }
      
      //check if pagibig is checked 
      if(isset($_POST['pagibig'])){
        $pagibig = $_POST['pagibig'];
      }else{
        $pagibig = null;
      }
      
     

isset($_POST['sss']);
if (filter_has_var(INPUT_POST, 'sss')) {
        $num1 = $salary;       
        $sss_result = $num1 * 0.045;
}
else {
        $sss_result = '0 - not a member';
}

if (filter_has_var(INPUT_POST, 'philhealth')) {
        $num1 = $salary; 
        $phil_result = $num1 * 0.045;
}
else {
        $phil_result = '0 - not a member';
}

if (filter_has_var(INPUT_POST, 'pagibig')) {
        $num1 = $salary; 

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

        $tax = $salary;

        if ($tax <= 20833) {
            $tax = $salary * 0.00;
        }
        else if ($tax >=20834 || $tax <=33332) {
            $tax = $salary * 0.15;
        }
        else if ($tax >=33333 || $tax <=66666) {
            $tax = ($salary * 0.20) + 1875; //20% of totalearn + 1875
        }
        else if ($tax >=66667 || $tax <=166666) {
            $tax = ($salary * 0.25) + 8541.80;
        }
        else if ($tax >=166667|| $tax <=666666) {
            $tax = ($salary * 0.30) + 33541.80;
        }
        else $tax = ($tax >=666667) ? ($salary * 0.35) + 183541.80 : 'error';


        // $networth = $salary - ($sss_result + $phil_result + $love_result) ;
        $totaldeductions = $sss_result + $phil_result + $love_result + $tax;
        $grosspay = $salary - $totaldeductions; //
        $networth = $totalAllowance + $grosspay;

    
if ($admin->checkprlist($prlistid)) {
    $admin->insertEmployeePayslipForm($fname, $position, $branch, $department,  $date, $date1, $present, $overtime, $salary, $sssChecked,$pagibigChecked, $philhealthChecked, $food_allowance, $transpo_allowance, $employeeId);
    $admin->insertEmployeePayslip($fname, $networth, $prlistid, $employeeId,$prlistType);
}
}

?>