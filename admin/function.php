<?php 

 require_once __DIR__ . '/vendor/autoload.php';
 require '../Classes/admin.php';
 require '../Classes/database.php';
 
 $prlistId = $_POST["prlist-id"];
 $database = new Database();
 $admin = new Admin($database);
 $payslip = new Payroll($database);

 $employee = $admin->getAllEmployeePayslip($prlistId);

//  $payslip->payrollDetails($id);

//  $employeepayslip = $admin->getEmployeePayslipTable($employee[0]["id"]);

 foreach ($employee as $emp) {
    foreach ($emp as $key => $value) {
  
        //getting data from employee_payslip_form
      $employeepayslip = $admin->getEmployeePayslipTable($value);

      //getting data from employee_details
      $employeeDetails = $admin->getEmployeeDetails($employeepayslip["employee_id"]);

    
  
      if($employeepayslip){

        $prlist = $payslip->payrollDetails($prlistId);
        $paycode = '';
        $paytype = '';

        foreach($prlist as $list):
            $paycode = $list['code'];
            $paytype = $list['type'];
         endforeach;

        $fname = $employeepayslip['employee_name'];
        $position = $employeepayslip['position'];
        $branch = $employeepayslip['branch'];
        $department = $employeepayslip['department'];
        $date = $employeepayslip['from_date'];
        $date1 = $employeepayslip['to_date'];
        $num_hr = $employeeDetails[0]['num_hr'];

        $overtime = $employeeDetails[0]['over_time'];
        $ratePerHour = $employeeDetails[0]['rate_per_hour']; 

        $sss = $employeepayslip['sss']; 
        $philhealth = $employeepayslip['philhealth']; 
        $pagibig = $employeepayslip['pagibig']; 

        $totalearn = ($ratePerHour * $num_hr) + $overtime; //salary rate * number of hours completed
        // $grosspay = $totalearn + $totalallowance; -> (saka na'to pag okay na yung sa allowance)

        if ($sss == true) {
            $num1 = $totalearn;       
            $sss_result = $num1 * 0.14;
        }
        else {
            $sss_result = '0 - not a member';
        }

        if ($philhealth == true) {
            $num1 = $totalearn;
            $phil_result = $num1 * 0.045;
        }
        else {
                $phil_result = '0 - not a member';
        }

        if ($pagibig == true) {
            $num1 = $totalearn;

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
            $tax = $totalearn * 0.05;
        }
        else if ($tax >=10001 || $tax <=30000) {
            $tax = $totalearn * 0.10;
        }
        else if ($tax >=30001 || $tax <=70000) {
            $tax = $totalearn * 0.15;
        }
        else if ($tax >=70001 || $tax <=140000) {
            $tax = $totalearn * 0.20;
        }
        else if ($tax >=140001 || $tax <=250000) {
            $tax = $totalearn * 0.25;
        }
        else if ($tax >=250001 || $tax <=500000) {
            $tax = $totalearn * 0.30;
        }
        else $tax = ($tax >=500001) ? $totalearn * 0.32 : 'error';

        $networth = $totalearn - ($sss_result + $phil_result + $love_result + $tax);

        $totaldeductions = $sss_result + $phil_result + $love_result + $tax;
        
        $mdpf = new Mpdf\Mpdf();
        
        $data = '';
        
        $data = '
        <style>
            .column {
                width: 250px;}
            .column1 {
                width: 400px;
                padding: 5px;
                border: 1px solid black;
            }
            .column2 {
                width: 150px;
                padding: 5px;
                border: 1px solid black;
            }
            table {
                font-size: 12px;
            }
        </style>

        <div class="container" style="font-family: Bahnschrift;">
            <h1 style="margin-bottom: -20px; text-align: center;">3G CLOTHING LINE</h1>
            <p style="margin-bottom: 20; text-align: center;">Brgy. San Bartolome, Novaliches, Quezon City</p>
            <h2 style="margin-top: 0; text-align: center;">Generated Payslip</h2>

            <!---Table for Employee and Payroll Information-->
            <table style="display: flex; justify-content: center; margin-bottom: 30; margin-top: 20px;">
                <tbody>
                    <tr>
                        <td class="column" style="font-weight: bold;">Employee Name: </td>
                        <td class="column">'. $fname .'</td>
                        <td class="column" style="font-weight: bold;">Payroll Code: </td>
                        <td class="column">'. $paycode .'</td>
                    </tr>
                    
                    <tr>
                        <td class="column" style="font-weight: bold;">Department: </td>
                        <td class="column">'. $department .'</td>
                        <td class="column" style="font-weight: bold;">Payroll Type: </td>
                        <td class="column">'. $paytype .'</td>
                    </tr>

                    <tr>
                        <td class="column" style="font-weight: bold;">Position: </td>
                        <td class="column">'. $position .'</td>
                        <td class="column" style="font-weight: bold;">From Date: </td>
                        <td class="column">'. $date .'</td>
                    </tr>

                    <tr>
                        <td class="column" style="font-weight: bold;">Branch: </td>
                        <td class="column">'. $branch. '</td>
                        <td class="column" style="font-weight: bold;">To Date: </td>
                        <td class="column">'. $date1 .'</td>
                    </tr>
                </tbody>
            </table>


            <!---Table for Earnings-->
            <table style="border-collapse: collapse; width: 80%; margin: auto; margin-bottom: 20;">
                <tr style="text-align:center; font-weight: bold; color: white; background-color: #0d6efd;">
                    <td class="column1" style="text-align: center; color: white;"">EARNINGS</td>
                    <td class="column2" style="text-align: center; color: white;"">AMOUNT</td> 
                </tr>

                <tr>
                    <td class="column1">Worked Hours</td>
                    <td class="column2" style="text-align: right;">'. $num_hr .'</td>
                </tr>

                <tr>
                    <td class="column1">Hourly Rate</td>
                    <td class="column2" style="text-align: right;">' . '₱' . $ratePerHour .'</td>
                </tr>

                <tr>
                    <td class="column1">Overtime</td>
                    <td class="column2" style="text-align: right;">'. $overtime .'</td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder;">TOTAL EARNINGS</td>
                    <td class="column2" style="text-align: right; font-weight: bolder;">'. $totalearn .'</td>
                </tr>
            </table>


            <!---Table for Allowances-->
            <table style="border-collapse: collapse; width: 80%; margin: auto; margin-bottom: 20;">
                <tr style="text-align:center; font-weight: bold; color: white; background-color: #0d6efd;">
                    <td class="column1" style="text-align: center; color: white;"">ALLOWANCES</td>
                    <td class="column2" style="text-align: center; color: white;"">AMOUNT</td> 
                </tr>

                <tr>
                    <td class="column1">Food</td>
                    <td class="column2" style="text-align: right;">No data</td>
                </tr>

                <tr>
                    <td class="column1">Transportation</td>
                    <td class="column2" style="text-align: right;">No data</td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder;">TOTAL ALLOWANCES</td>
                    <td class="column2" style="text-align: right; font-weight: bolder;">No data</td>
                </tr>
            </table>


            <!---Table for Benefits-->
            <table style="border-collapse: collapse; width: 80%; margin: auto; margin-bottom: 20;">
                <tr style="text-align:center; font-weight: bold; color: white; background-color: #0d6efd;">
                    <td class="column1" style="text-align: center; color: white;">BENEFITS</td>
                    <td class="column2" style="text-align: center; color: white;">AMOUNT</td> 
                </tr>

                <tr>
                    <td class="column1">Vacation Leave</td>
                    <td class="column2" style="text-align: right;">No data</td>
                </tr>

                <tr>
                    <td class="column1">Health Insurance</td>
                    <td class="column2" style="text-align: right;">No data</td>
                </tr>

                <tr>
                    <td class="column1">Christmas Bonus</td>
                    <td class="column2" style="text-align: right;">No data</td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder;">TOTAL BENEFITS</td>
                    <td class="column2" style="text-align: right; font-weight: bolder;">No data</td>
                </tr>
            </table>

            <!---Table for Deductions-->
            <table style="border-collapse: collapse; width: 80%; margin: auto; margin-bottom: 20;">
                <tr style="text-align:center; font-weight: bold; color: white; background-color: #0d6efd;">
                    <td class="column1" style="text-align: center; color: white;">DEDUCTIONS</td>
                    <td class="column2" style="text-align: center; color: white;">AMOUNT</td> 
                </tr>

                <tr>
                    <td class="column1">SSS</td>
                    <td class="column2" style="text-align: right;">' . '₱' . $sss_result .'</td>
                </tr>

                <tr>
                    <td class="column1">Pag-ibig</td>
                    <td class="column2" style="text-align: right;">' . '₱' . $love_result.'</td>
                </tr>

                <tr>
                    <td class="column1">Philhealth</td>
                    <td class="column2" style="text-align: right;">' . '₱' . $phil_result .'</td>
                </tr>

                <tr>
                    <td class="column1">Withholding Tax</td>
                    <td class="column2" style="text-align: right;">' . '₱' . $tax .'</td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder;">TOTAL DEDUCTIONS</td>
                    <td class="column2" style="text-align: right; font-weight: bolder;">'. '₱' . $totaldeductions .'</td>
                </tr>
            </table>

            <!---Table for Overall Total-->
            <table style="border-collapse: collapse; width: 80%; margin: auto; margin-bottom: 20;">
                <tr style="text-align:center; font-weight: bold; background-color: #0d6efd;">
                    <td class="column1" style="text-align: center; color: white;">OVERALL TOTAL</td>
                    <td class="column2" style="text-align: center; color: white;">AMOUNT</td> 
                </tr>

                <tr>
                    <td class="column1">Gross Pay</td>
                    <td class="column2" style="text-align: right;"> $grosspay </td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder; color: red;">NET PAY</td>
                    <td class="column2" style="text-align: right; font-weight: bolder; color: red;">' . '₱' . $networth . '</td>
                </tr>
            </table>   
        </div>
        ';

        $mdpf->WriteHTML($data);
        $mdpf->Output($fname . '_' . $date . ' - payslip.pdf', 'D');
  
      }
    }
  }
?>