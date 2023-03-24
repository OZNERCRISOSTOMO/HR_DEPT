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
    foreach($employees as $employee){;
        echo '<div class="card" style="width: 18rem;">';
        echo "<div class='card-body'>";

            echo '<img src="../Images/1x1 photo.png" alt="avatar" style="width: 150px;" class="img-fluid m-0 rounded-circle">';
             echo '<h5 class="card-title text-center">'. $employee["first_name"]." " . $employee["last_name"] . '  </h5>';         
                echo '<p class="">'. $employee["email"]. '  </p>';
                 echo '<p class="">'. $employee["gender"]. '  </p>';  
                echo '<p class="">'. $employee["department"]. '  </p>'; 
                echo '<p class="">'. $employee["contact"]. '  </p>'; 
                 echo '<p class=""> Date hired : '. $admin->formatDate($employee["date_applied"]) . '</p>';
       
             
        echo "</div>";
         echo "</div>";
    }

}else{
    echo "none";
}
  
