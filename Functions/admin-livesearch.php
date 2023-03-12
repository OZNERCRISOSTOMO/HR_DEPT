<?php
//Including Database configuration file.
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);

//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {

//Search box value assigning to $name variable.
   $name = $_POST['search'];

    $employees;
    if($name == "all"){
        $employees = $admin->getEmployees();
    }else{
        $employees = $admin->searchEmployees($name);
    }
    

    // var_dump($employees);
    foreach($employees as $employee){
        echo "<div class='employee-list-container'>";
           
                echo '<p class="">'. $employee["first_name"]." " . $employee["last_name"] . '  </p>';           
                echo '<p class="">'. $employee["email"]. '  </p>';
                 echo '<p class="">'. $employee["gender"]. '  </p>';  
                echo '<p class="">'. $employee["department"]. '  </p>'; 
                echo '<p class="">'. $employee["contact"]. '  </p>'; 
                     $formatted_date = date('M d Y, h:i A', strtotime($employee["date_applied"]));
                          echo '<p class="">'. $formatted_date. '  </p>';
       
             
        echo "</div>";
    }

}else{
    echo "none";
}
  
