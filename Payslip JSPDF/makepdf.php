<?php

require_once __DIR__ . '/vendor/autoload.php';

$fname = $_POST['fname'];
$position = $_POST['position'];
$branch = $_POST['branch'];
$email = $_POST['email'];
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
        $sss_result = $num1 * 0.04;
}
else {
        $sss_result = '0 - not a member';
}

if (filter_has_var(INPUT_POST, 'philhealth')) {
        $num1 = $_POST['salary'];
        $phil_result = $num1 * 0.05;
}
else {
        $phil_result = '0 - not a member';
}

if (filter_has_var(INPUT_POST, 'pagibig')) {
        $num1 = $_POST['salary'];
        $love_result = $num1 * 0.02;
}
else {
        $love_result = '0 - not a member';
}
$salaryOT = $salary + ($overtime * 60);

$networth = $salaryOT - ($sss_result + $phil_result + $love_result);

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
    border: 1px solid black;
    float: right;
    height: 25px;
    width: 20%;
}
</style>
<div style = "font-family: Century Gothic;">
        <center><h1>Company Name</h1></center>
        <center><h3>Generated Payslip</h3></center>


            <table>
                    <caption>Payroll Details</caption>
                    <tr>
                        <th>Full Name:</th>
                        <td>'. $fname .'</td>

                        <th>Position:</th>
                        <td>'. $position .'</td>
                    </tr>

                    <tr>
                        <th>Branch:</th>
                        <td>'. $branch. '</td>

                        <th>Email:</th>
                        <td>'. $email .'</td>
                    </tr>

                    <tr>
                        <th>From Date:</th>
                        <td>'. $date .'</td>

                        <th>To Date:</th>
                        <td>'. $date1 .'</td>
                    </tr>

                    <tr>
                        <th>Number of Present:</th>
                        <td>'. $present .'</td>

                        <th>Overtime per hr/s:</th>
                        <td>'. $overtime .'</td>
                    </tr>

                    <tr>
                        <th>Basic Salary:</th>
                        <td>' . '₱' . $salary .'</td>

                        <th>Base Salary plus OT:</th>
                        <td>' . '₱' . $salaryOT .'</td>
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
                    </tr>
            </table>

            <p><b>Total Salary:</b> ' . '₱' . $networth . '</p>
</div>';


$mdpf->WriteHTML($data);

$mdpf->Output($fname . '_' . $date . ' - payslip.pdf', 'D');
?>