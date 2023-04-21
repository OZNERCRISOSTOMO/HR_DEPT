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
   
            $html = ' <div class="card bg-white rounded ms-2 my-2 pt-3 employee-container" style="width: 18rem;" data-bs-toggle="modal"
                         id="view" data-bs-target="#viewmodal" data-employee-id="'. $employee["id"].'">
                        <img class="rounded-circle mx-auto" src="../Uploads/'. $employee["picture_path"] .'" style="object-fit: cover;border-radius: 50%;height: 140px; width: 140px;" alt="Employee Pic">    
                        <div class="card-body ps-1">
                            <h6 class="card-title text-center col-11 m-auto" name="EmployeeName">'. $employee["first_name"] . " " .$employee["last_name"]  .'</h6>
                            <p class="card-text text-center" style="opacity: 0.7;">'. ucfirst($employee["position"]) .'</p>
                            
                            <div id="inCard"  style=" background-color: #f2f2f2;"; class="col-12 rounded m-auto align-content-center ms-2 ">
                            <table class="table table-borderless p-0 m-0 pb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th style="font-size: 14px;">Department:</th>
                                        <th style="font-size: 14px;">Date Hired: </th>
                                       
                                    </tr>
                                    

                                </thead> 
                               
                                <tbody>
                                <tr >
                                        <td class="ps-4" name="Department" style="font-size: 13.5px;">'. ucfirst($employee["department"]). '</td>
                                        <td class="ps-3" name="DateHired" style="font-size: 13.5px;">'. $admin->formatDate($employee["date_hired"]) . '</td>
                                    </tr>   
                                </tbody>

                               
                            </table>
                            
                                <div class="col-12 mt-2">

                                <div class="d-flex ms-3">
                                <i class="fa-solid fa-star text-warning pe-2"></i> <p class="text d-flex flex-column col-10"  style="font-size: 13px;" name="Email">P 215pr/hr</p>
                                </div>

                                <div class="d-flex ms-3">
                                <i class="fa-solid fa-envelope text-primary text pe-2"></i> <p class="text d-flex flex-column col-10"  style="font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" name="Email">'. $employee["email"] .'</p>
                                </div>

                            <div class="d-flex ms-3">
                            <i class="fa-solid fa-phone text-success pe-2"></i> <p class="text d-flex flex-column col-10"  style="font-size: 13px;" name="Email">'. $employee["contact"] .'</p>
                            </div>
                        
                             </div>
                           
                        </div>
                        </div>
                    </div>';


                    echo $html;
    }

}else{
    echo "none";
}
  
