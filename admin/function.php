<?php 
 require_once __DIR__ . '/vendor/autoload.php';
 require '../Classes/admin.php';
 require '../Classes/database.php';
 
 $database = new Database();
 $admin = new Admin($database);
 $employee = $admin->getAllEmployeePayslip();

 $admin->getEmployeePayslipTable($employee[0]["id"]);
 $employeepayslip = $admin->getEmployeePayslipTable($employee[0]["id"]);

 foreach ($employee as $emp) {
    foreach ($emp as $key => $value) {
  
      $employeepayslip = $admin->getEmployeePayslipTable($value);
  
      if($employeepayslip){
  
        $fname = $employeepayslip['employee_name'];
        $position = $employeepayslip['position'];
        $branch = $employeepayslip['branch'];
        $department = $employeepayslip['department'];
        $date = $employeepayslip['from_date'];
        $date1 = $employeepayslip['to_date'];
        $present = $employeepayslip['number_present'];
        $salary = $employeepayslip['rate'];
        
        $sss = $employeepayslip['sss'];
        $philhealth = $employeepayslip['philhealth'];
        $pagibig = $employeepayslip['pagibig'];
        

        $salaryOT = $salary * $present; //salary rate * number of hours completed

        if ($sss == true) {
            $num1 = $salaryOT;       
            $sss_result = $num1 * 0.14;
        }
        else {
            $sss_result = '0 - not a member';
        }

        if ($philhealth == true) {
            $num1 = $salaryOT;
            $phil_result = $num1 * 0.045;
        }
        else {
                $phil_result = '0 - not a member';
        }

        if ($pagibig == true) {
            $num1 = $salaryOT;

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
                echo 'error';
        }
        }
        else {
                $love_result = '0 - not a member';
        }


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

        $networth = $salaryOT - ($sss_result + $phil_result + $love_result + $tax);
        
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
        
                                <th>Hourly Rate:</th>
                                <td>' . '₱' . $salary .'</td>
        
                                
                            </tr>
        
                            <tr>
                                <th>Position:</th>
                                <td>'. $position .'</td>
        
                                <th>Branch:</th>
                                <td>'. $branch. '</td>
                            </tr>
        
        
                            <tr>
                                <th>Total hours present:</th>
                                <td>'. $present .'</td>
        
                                <th>Gross pay:</th>
                                <td>'. $salaryOT .'</td>
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
  
      }
    }
   
  }

$mdpf->WriteHTML($data);
$mdpf->Output($fname . '_' . $date . ' - payslip.pdf', 'D');
?>