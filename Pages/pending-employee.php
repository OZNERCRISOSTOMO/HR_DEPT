     <div class="pending-employee-list ">
        <div>
            <h1>Pending Employees</h1>
                </div>

                    <div class="pending-employee-list-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Contact No</th>
                                    <th scope="col">Resume</th>
                                     <th scope="col">Picture</th>
                                    <th scope="col">Date Applied</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="action">
                                <?php
                                    $pendingEmployees = $admin->getPendingEmployees();
                                
                                    foreach($pendingEmployees as $employee){

                                    echo '<tr>';
                                        echo '<th scope="row">1 </th>';
                                        echo '<td>'. $employee["first_name"] ." ". $employee["last_name"] .'</td>';
                                        echo '<td>'. $employee["email"] .'</td>';
                                        echo '<td>'. $employee["gender"] .'</td>';
                                        echo '<td>'. $employee["contact"] .'</td>';
                                    ?>
                                        <td>
                                            <a href="../Uploads/<?php echo $employee['resume_path']?>" target="_thapa">
                                                <?php echo $employee['resume_name']?>
                                            </a>
                                        </td>
                                        <td>
                                             <a href="../Uploads/<?php echo $employee['picture_path'];
                                                                        ?>" target="_thapa">
                                                Picture
                                            </a>
                                        </td>
                                     <?php
                                         echo '<td>'. $admin->formatDate($employee["date_applied"]) .'</td>';
                                     ?>
                                        <td>
                                            <input type="hidden" name="employee_id" value="<?php echo $employee["id"] ?>">
                                            <input type="hidden" name="employee_email" value="<?php echo $employee["email"] ?>">
                                            <input type="hidden" name="employee_lastname" value="<?php echo $employee["last_name"] ?>">
                                            <button type="button" class="btn btn-outline-success acceptBtn"> Accept</button>
                                            <button type="button" class="btn btn-outline-danger declineBtn">Decline</button>
                                        </td>
                                     <?php
                                    echo "</tr>";

                                    }
                                    ?>
                            </tbody>
                        </table>

                <!--============= ACCEPT MODAL =============== -->

            <div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            
                    <div class="modal-body">
                        <form method="POST" action="../Functions/employee-accept-pending.php">
                            <!--==== DEPARTMENT ===== -->
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="department" id="department">
                                <option selected>Select department</option>
                                <option value="human-resource">Human Resources</option>
                                <option value="sales">Sales</option>
                                <option value="purchaser">Purchaser</option>
                                <option value="warehouse">Warehouse</option>
                        
                                </select>
                            </div>

                                    <!--===== TYPE ====== -->
                            <div class="mb-3 d-flex">
                                Type : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="regular" id="regular" name="type" required>
                                    <label class="form-check-label" for="regular">Regular</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="non-regular" id="non-regular" name="type" required>
                                    <label class="form-check-label" for="non-regular">Non-Regular</label>
                                </div>
                            </div>
                            
                            
                            <!--===== POSITION ====== -->
                            <div class="mb-3 d-flex">
                                Position : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="employee" id="employee" name="position" required>
                                    <label class="form-check-label" for="employee">Employee</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="admin" id="admin" name="position" required>
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                            </div>

                                   <!--==== POSITION DROPDOWN ===== -->
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="department-position" id="department-position" required>
                                <option selected>Select position</option>
        
                                </select>
                            </div>

                              <!--===== SCHEDULE ====== -->
                            <div class="mb-3 d-flex">
                                Schedule : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="1" id="1" name="schedule" required>
                                    <label class="form-check-label" for="1">8:00 AM - 5:00 PM</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="2" id="2" name="schedule" required>
                                    <label class="form-check-label" for="2">6:00 PM - 10:00 PM</label>
                                </div>
                            </div>
                            
                              <!--==== BRANCH ======== -->
                            <div class="mb-3">
                                <label for="branch" class="col-form-label">Branch</label>
                                <input type="text" class="form-control" id="branch" name="branch" required>
                            </div>

              
                            <!--===== RATE  ===== -->
                            <div class="mb-3">
                                <label for="rate" class="col-form-label">Rate</label>
                                <input type="number" class="form-control" id="rate" name="rate" value="1" disabled>
                                <input type="hidden" class="form-control" id="rate-hidden" name="rate" value="0" >
                            </div>

                           
                            <div class="col-12 mb-4 benefits-container">
                                
                                <div class="col-6">
                                     <h4>Benefits</h4>     
                                    <label for="vacation-leave" class="col-form-label">Vacation leave</label>
                                    <input type="number" class="form-control" id="vacation-leave" name="vacation-leave" value="15" disabled>
                                    <input type="hidden" class="form-control vacation-leave" id="vacation-leave" name="vacation-leave" value="15" >

                                    <label for="vacation-leave" class="col-form-label">Sick leave</label>
                                    <input type="number" class="form-control " id="sick-leave" name="sick-leave" value="60" disabled>
                                      <input type="hidden" class="form-control sick-leave" id="sick-leave" name="sick-leave" value="60" >
                                </div>
                                
                                <div class="col-6 align-self-end ms-3">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="health-insurance" name="health-insurance" checked >
                                    <label class="form-check-label" for="health-insurance"> Health insurance </label>
                                 </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="christmas-bonus" name="christmas-bonus" checked >
                                     <label class="form-check-label" for="christmas-bonus"> Chrirstmas Bonus </label >
                                </div> 
                                </div>

                                <h5>Allowance</h5>
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="food-allowance" name="food-allowance" checked >
                                     <label class="form-check-label" for="food-allowance"> Food allowance </label  >
                                </div> 
                                 <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="transpo-allowance" name="transpo-allowance" checked >
                                     <label class="form-check-label" for="transpo-allowance"> Transportation allowance</label>
                                </div> 
                     
                            </div>

                            
                            <!-- BENEFICARIES -->
                            <div class="col-12 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="sss" id="sss" name="beneficiaries[]">
                                    <label class="form-check-label" for="sss"> SSS </label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="pagibig" id="pagibig" name="beneficiaries[]">
                                    <label class="form-check-label" for="pagibig"> Pagibig </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="philhealth" id="philhealth" name="beneficiaries[]">
                                     <label class="form-check-label" for="philhealth"> Philhealth </label>
                                </div> 
                            </div>
                            
                            <!-- RFID CARD -->
                            <div class="mb-3 mt-3">
                                <select class="form-select" aria-label="Default select example" name="rfid-card" id="rfid-card" >
                                <option selected value="0">Select available RFID card</option>
                                 <?php 
                                    $rfidCards = $admin->getAllRfidCard();

                                  foreach($rfidCards as $card){

                                    if($card["employee_id"] == null){
                                        echo "<option value='".$card["serial_number"] ."'>". $card["serial_number"] ."</option>";
                                    }
                                    
                                    
                                  }
                                ?>
                                </select>
                            </div>

                            <!-- HIDDEN INPUT TO STORE EMPLOYEE ID -->
                            <input type="hidden" name="employee_id" id="employee_id_accept">
                            <input type="hidden" name="employee_email" id="employee_email_accept">
                            <input type="hidden" name="employee_lastname" id="employee_lastname_accept">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button name="submit" class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </form>
                    </div>
      
                    </div>
                </div>
            </div>
            <!-- ============================================= -->

            <!--============= DECLINE MODAL =============== -->

            <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            
                    <div class="modal-body">
                        <form method="POST" action="../Functions/employee-accept-pending.php">
                            <!--==== DEPARTMENT ===== -->
                            <div class="mb-3">
                                <select class="form-select" aria-label="Default select example" name="department">
                                <option selected>Select department</option>
                                <option value="sales">Sales</option>
                                <option value="inventory">Inventory</option>
                                </select>
                            </div>

                    
                            <!--===== POSITION ====== -->
                            <div class="mb-3 d-flex">
                                Position : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="employee" id="employee" name="position" required>
                                    <label class="form-check-label" for="employee">Employee</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="admin" id="admin" name="position" required>
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                            </div>

                      
                            
                            <!--==== SALARY ======== -->
                            <div class="mb-3">
                                <label for="salary" class="col-form-label">Salary</label>
                                <input type="number" class="form-control" id="salary" name="salary">
                            </div>
                            
                            <!--===== WORKING HOURS ===== -->
                            <div class="mb-3">
                                <label for="working-hours" class="col-form-label">Working hours</label>
                                <input type="number" class="form-control" id="working-hours" name="working-hours">
                            </div>

                            
                            <!-- BENEFICARIES -->
                            <div class="col-12 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="sss" id="sss" name="beneficiaries[]">
                                    <label class="form-check-label" for="sss"> SSS </label>
                                </div>
            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="pagibig" id="pagibig" name="beneficiaries[]">
                                    <label class="form-check-label" for="pagibig"> Pagibig </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="philhealth" id="philhealth" name="beneficiaries[]">
                                     <label class="form-check-label" for="philhealth"> Philhealth </label>
                                </div> 
                            </div>

                            <!-- HIDDEN INPUT TO STORE EMPLOYEE ID -->
                            <input type="hidden" name="employee_id" id="employee_id_decline">
                            <input type="hidden" name="employee_email" id="employee_email_decline">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button name="submit" class="btn btn-primary" type="submit"> Submit</button>
                            </div>
                        </form>
                    </div>
      
                    </div>
                </div>
            </div>
    </div>
</div>