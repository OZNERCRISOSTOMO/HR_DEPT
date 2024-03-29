<?php 

 require_once __DIR__ . '/vendor/autoload.php';
 require '../Classes/admin.php';
 require '../Classes/database.php';
 
 if(isset($_POST["submit-generate"])){
     $prlistId = $_POST["prlist-id"];
     $prlistType = $_POST["prlist-type"];
 $database = new Database();
 $admin = new Admin($database);
 $payslip = new Payroll($database);

 $employee = $admin->getAllEmployeePayslip($prlistId);

//  $payslip->payrollDetails($id);

//  $employeepayslip = $admin->getEmployeePayslipTable($employee[0]["id"]);

// create an empty array to store the PDF data
// $pdf_data = array();

 foreach ($employee as $emp) {
    // foreach ($emp as $key => $value) {

        if($emp["file_path"] != "Not generated"){
            continue;
        }
  
       //getting data from employee_payslip_form
      $employeepayslip = $admin->getEmployeePayslipTable($emp["id"] );

      //getting data from employee_details
      $employeeDetails = $admin->getEmployeeDetails($employeepayslip["employee_id"]);

    
        
      if($employeepayslip){
        $prlist = $payslip->payrollDetails($prlistId);
        $paycode = '';
        $paytype = '';

        foreach($prlist as $list):
            $paycode = $list['id'];
            $paytype = $list['type'];
         endforeach;
        
        $id = $employeepayslip['employee_id'];
        $fname = $employeepayslip['employee_name'];
        $position = $employeepayslip['position'];
        $branch = $employeepayslip['branch'];
        $department = $employeepayslip['department'];
        $date = $employeepayslip['from_date'];
        $date1 = $employeepayslip['to_date'];
        
        $fullNamePayslip = $fname;
        $fullName = $fname;
        $fullNameParts = explode(" ", $fullName);
        $fname = $fullNameParts[count($fullNameParts) - 1];
         
        $num_hr = 0;
        $overtime = 0;

        if($prlistType == "resignation" || $prlistType == "termination"){
            $num_hr = $employeeDetails[0]['num_hr']; 
            $overtime = $employeeDetails[0]['over_time']; 
        }

        if($prlistType == "semimonthly" || $prlistType == "monthly"){
    
            $dataCalculate  = $payslip->calculateTotalHourAndOvertime($date,$date1,$id);
            $num_hr = $dataCalculate["sahod"] ?? 0 ;
            $overtime = $dataCalculate["overtime"] ?? 0;
        
        }
        
        
        

        $ratePerHour = $employeeDetails[0]['rate_per_hour']; 
        $food = 0;
        $transpo = 0;

        if($prlistType == "semimonthly" || $prlistType == "monthly"){
            $food = $employeeDetails[0]['food_allowance'];
            $transpo = $employeeDetails[0]['transpo_allowance'];
        }

        $sss = $employeepayslip['sss']; 
        $philhealth = $employeepayslip['philhealth']; 
        $pagibig = $employeepayslip['pagibig']; 

        $totalearn = $ratePerHour * ($num_hr + $overtime); //salary rate * number of hours completed
        $totalallowance = $food + $transpo;
        

        if ($sss == true) {
            $num1 = $totalearn;       
            $sss_result = $num1 * 0.045;
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

        $tax = $totalearn;

        if ($tax <= 20833) {
            $tax = $totalearn * 0.00;
        }
        else if ($tax >=20834 || $tax <=33332) {
            $tax = $totalearn * 0.15;
        }
        else if ($tax >=33333 || $tax <=66666) {
            $tax = ($totalearn * 0.20) + 1875; //20% of totalearn + 1875
        }
        else if ($tax >=66667 || $tax <=166666) {
            $tax = ($totalearn * 0.25) + 8541.80;
        }
        else if ($tax >=166667|| $tax <=666666) {
            $tax = ($totalearn * 0.30) + 33541.80;
        }
        else $tax = ($tax >=666667) ? ($totalearn * 0.35) + 183541.80 : 'error';

        $totaldeductions = $sss_result + $phil_result + $love_result + $tax;
        $grosspay = $totalearn - $totaldeductions; //
        $networth = $totalallowance + $grosspay;

        if($prlistType == "resignation" || $prlistType == "termination"){
            $dateHired = $date;
            $dateNow = $date1; // Get the current date
            
            $yearsDiff = date('Y', strtotime($dateNow)) - date('Y', strtotime($dateHired));

            if ($yearsDiff != 0) {
                $networth = $networth / $yearsDiff;
            }
        }

        //get the login_id from employee_login
        $loginId =  $admin->getLoginId($employeeDetails[0]["employee_id"]);
    
        //extract the 4 number and set it as password
        $password = preg_replace("/[^0-9]/", "", $loginId["login_id"]);
    
        $mdpf = new \Mpdf\Mpdf(['format' => 'LETTER', 'orientation' => 'P']);
        $mdpf->SetProtection( ['print', 'modify', 'copy', 'annot-forms', 'fill-forms', 'extract', 'assemble', 'print-highres'],
            $fname, $password, 128);
        
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
                        <td class="column">'. $fullNamePayslip .'</td>
                        <td class="column" style="font-weight: bold;">Payroll ID: </td>
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
                    <td class="column2" style="text-align: right;">'. $food .'</td>
                </tr>

                <tr>
                    <td class="column1">Transportation</td>
                    <td class="column2" style="text-align: right;">'. $transpo .'</td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder;">TOTAL ALLOWANCES</td>
                    <td class="column2" style="text-align: right; font-weight: bolder;">'. $totalallowance .'</td>
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
                    <td class="column2" style="text-align: right;">'. $grosspay .'</td>
                </tr>

                <tr>
                    <td class="column1" style="text-align: right; font-weight: bolder; color: red;">NET PAY</td>
                    <td class="column2" style="text-align: right; font-weight: bolder; color: red;">' . '₱' . $networth . '</td>
                </tr>
            </table>   
        </div>
        ';
        
        $document_path = '../Uploads/';

        $mdpf->WriteHTML($data);

        $timestamp = time(); // get current timestamp

        $filename = $fname. '_' . $date . '-' . $timestamp . '.pdf'; // append timestamp to filename

        $file_path = $document_path . $filename;

        echo $filename;
        echo "</br>";
        echo $file_path;

        $mdpf->Output($file_path, 'F');

        // save the file name to database
        $admin->insertPayslipFilePath($filename, $employeepayslip["employee_id"]);
  
      }
    
  }
     

    header("Location: pslist.php?id=$prlistId&status=generated&type=$prlistType");


 }


?>
