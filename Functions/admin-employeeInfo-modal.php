<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

//Getting value of "search" variable from "employee-list-script.js".
if (isset($_POST['id'])) {

//Search box value assigning to $employeeId variable.
   $employeeId = $_POST['id'];

    $employee = $admin->getEmployees($employeeId);
   
    $data = '
         
    <div class="flex-fill p-2">
      <img class="rounded-circle mx-auto d-block" src="../Uploads/'. $employee["picture_path"] .'" height="150" width="150" alt="Employee Pic">
      <h2 class="text" name="EmployeeName">'.  $employee["first_name"] ." ". $employee["last_name"].'</h2>
      <p class="text text-center">'. ucfirst($employee["department"]) .'</p>
      <div class="rounded ms-3"></div>
    </div>
    <div class="flex-fill p-2">
      <div class="form-floating">
        <h5 style="font-family: Bahnschrift;">Personal Information</h5>
        <table class="table table-borderless mt-2">
          <thead>
            <tr>
              <th><p class="text" style="opacity: 0.5;">Employee ID </p></th>
              <th><p class="text" style="opacity: 0.5;">Date Hired </p></th>
              <th><p class="text" style="opacity: 0.5;">Email </p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p class="text" style=";">0001-AAA</p></td>
              <td>'.$admin->formatDate($employee["date_hired"] ) .'</td>
              <td>'.$employee["email"] .'</td>
            </tr>
            <tr>
              <th><p class="text" style="opacity: 0.5;">Contact Number </p></th>
              <th><p class="text" style="opacity: 0.5;">Birthdate </p></th>
            </tr>
            <tr>
              <td>'.$employee["contact"].'</td>
              <td>21/02/2002</td>
            </tr>
          </tbody>
        </table>
        <h5 style="font-family: Bahnschrift;">Benefits</h5>
        <table class="table table-borderless mt-2">
          <thead>
            <tr>
              <th><p class="text" style="opacity: 0.5;"> SSS </p></th>
              <th><p class="text" style="opacity: 0.5;">TIN </p></th>
              <th><p class="text" style="opacity: 0.5;">PhilHealth </p></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><p class="text" style=";">0000-0000000-0</p></td>
              <td>000-000-000-0000</td>
              <td>0000-0000-0000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    ';

    echo $data;
  

}else{
    echo "none";
}
  
