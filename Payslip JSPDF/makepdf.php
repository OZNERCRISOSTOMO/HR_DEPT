<?php

require_once __DIR__ . '/vendor/autoload.php';
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

$salaryOT = $salary + ($overtime * 60);

$networth = $salaryOT - ($sss_result + $phil_result + $love_result);

if ($tax <= 10000) {
    $tax = $salaryOT * 0.05;
}
else if ($tax >=10001 || $tax <=30000) {
    $tax = $salaryOT * 0.10;
}
else if ($tax >=30001 || $tax <=70000) {
    $tax = $salaryOT * 0.15;
}
else if ($tax >=70001 || $tax <=140000) {
    $tax = $salaryOT * 0.20;
}
else if ($tax >=140001 || $tax <=250000) {
    $tax = $salaryOT * 0.25;
}
else if ($tax >=250001 || $tax <=500000) {
    $tax = $salaryOT * 0.30;
}
else $tax = ($tax >=500001) ? $salaryOT * 0.32 : 'error';

$sql = 


$mdpf = new Mpdf\Mpdf();

$data = '';

$data = '
<style type="text/css">
table {
    width: 100%;
    background: #eee;
    padding: 10px;
    font-size: 13px;
    font-family: Arial;
    border-spacing: 0;
}
th {
    background-color: #ddd;
    padding: 4px;
    width: 100px;
}
td {
    padding: 4px;
    border-bottom: solid thin #ddd;
}
h1 {
    text-align: center; 
    font-family: Century Gothic;
}
h3 {
    text-align: center; 
    font-family: Century Gothic;
}
caption {
    text-align: center; 
    border: 2px solid black;
}
p {
    text-align: center;
    font-size: 18px;
    border: 1px solid black;
    float: right;
    height: 25px;
    width: 30%;
}
</style>
<div style = "font-family: Century Gothic;">
        <center><h1>Company Name</h1></center>
        <center><h3>Generated Payslip</h3></center>


            <table>
                    <caption>Payroll Details</caption>
                    <tr>
                        <th>Payroll Code </th>
                        <td>No Data Yet</td>

                        <th>Type </th>
                        <td>No data Yet</td>
                    </tr>

                    <tr>
                        <th>Cut-off Start</th>
                        <td>No data Yet</td>

                        <th>Cut-off End</th>
                        <td>No data Yet</td>
                    </tr>
            </table>

            <table>
                    <caption>Employee Details</caption>
                    <tr>
                        <th>Full Name:</th>
                        <td>'. $fname .'</td>

                        <th>Gross Pay:</th>
                        <td>' . '₱' . $salaryOT .'</td>

                        
                    </tr>

                    <tr>
                        <th>Position:</th>
                        <td>'. $position .'</td>

                        <th>Branch:</th>
                        <td>'. $branch. '</td>
                    </tr>


                    <tr>
                        <th>Number of Present:</th>
                        <td>'. $present .'</td>

                        <th>Overtime per hr/s:</th>
                        <td>'. $overtime .'</td>
                    </tr>

                    <tr>

                    </tr>
            </table>

            <table>
                    <caption>Allowances:</caption>
                    <tr>
                        <th>SSS: </th>
                        <td>' . '₱' . $sss_result .'</td>

                        <th>Pag-ibig: </th>
                        <td>' . '₱' . $love_result .'</td>

                        <th>Philhealth: </th>
                        <td>' . '₱' . $phil_result .'</td>

                        <th>Withholding Tax: </th>
                        <td>' . '₱' . $tax .'</td>
                    </tr>
            </table>

            <table>
                    <caption>Deductions:</caption>
                    <tr>
                        <th>SSS: </th>
                        <td>' . '₱' . $sss_result .'</td>

                        <th>Pag-ibig: </th>
                        <td>' . '₱' . $love_result .'</td>

                        <th>Philhealth: </th>
                        <td>' . '₱' . $phil_result .'</td>

                        <th>Withholding Tax: </th>
                        <td>' . '₱' . $tax .'</td>
                    </tr>
            </table>

            <p><b>Net Pay:</b> ' . '₱' . $networth . '</p>
</div>';


$mdpf->WriteHTML($data);
$admin->checkprlist($id);
$mdpf->Output($fname . '_' . $date . ' - payslip.pdf', 'D');

?>