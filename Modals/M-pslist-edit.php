<!-- Modal -->
<div class="modal fade" id="staticBackdrop-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Payslip</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="../Functions/admin-payslipform-edit.php" method="post" class="offset-md-3 col-md-6" id="myForm">
                <p>Fill out the form to generate payslip into PDF</p>

                <div class="row mb-2">
                    <div class="col-md-6" >
                         
                            <select id='select-employee-edit' name="employee-id" class="select2-container col-11">
                                <option value="0">Select employee</option>
                           <?php
                                $employees = $admin->getEmployees();

                                foreach($employees as $employee){
                                    echo "<option value='".$employee['id'] ."'>". $employee['first_name']." ".$employee['last_name']  ."</option> ";
                                }
                            ?>
                            </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="position" placeholder="Position" class="form-control" id="position-edit" disabled >
                    </div>

                </div>

                <div class="mb-2">
                <input type="text" name="branch" placeholder="Branch" class="form-control" id="branch-edit" >
                </div>

                <div class="mb-2">
                <input type="text" name="department" placeholder="Department" class="form-control" id="department-edit" disabled>
                </div>

                <div class="mb-2">
                <input type="email" name="email" placeholder="Email" id="email-edit" class="form-control" >
                </div>

                <?php
                        $prlist = $payslip->payrollDetails($id);
                        ?>
                        <?php foreach($prlist as $list): ?>
                <div class="mb-2">
                <p>From Date: </p>
                <input type="date" name="date-from" id="date-from" class="form-control" placeholder="From" value="<?php echo $list['start']; ?>"disabled>
                </div> 

                <div class="mb-2">
                <p>To Date: </p>
                <input type="date" name="date-to" id="date-to" class="form-control" placeholder="To" value="<?php echo $list['end']; ?>" disabled>
                </div>

                        <?php endforeach; ?>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="   number" name="present" id="present-edit" placeholder="Number of hour present" class="form-control" disabled>
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="overtime" id="overtime-edit" placeholder="Number of Overtime (per hour)" class="form-control" disabled>
                    </div>
                </div>

                 <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="number" name="food-allowance" id="food-allowance-edit" placeholder="Food allowance" class="form-control" value="0" disabled>
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="transpo-allowance" id="transpo-allowance-edit" placeholder="Transportation allowance" class="form-control" value="0" disabled>
                    </div>
                </div>
                
                <div class="mb-2">
                <input type="number" name="salary" id="salary-edit" placeholder="Salary" class="form-control" disabled>
                </div>

                <div class="deductions">
                    <p><b>Membership/Beneficiaries:</b></p>
                        <input type="checkbox" id="sss-edit" name="sss" value="0.04" name="beneficiaries[]" disabled>
                            <label for="beneficiaries1">SSS Beneficiaries</label><br>
                        <input type="checkbox" id="pagibig-edit" name="pagibig" value="0.02" name="beneficiaries[]" disabled>
                            <label for="beneficiaries2">Pag Ibig Beneficiaries</label><br>
                        <input type="checkbox" id="philhealth-edit" name="philhealth" value="0.05" name="beneficiaries[]" disabled  >
                            <label for="beneficiaries3">Philhealth Beneficiaries</label><br /><br />
                </div>
                    <input type="hidden" id="employee-name-edit" name="employee-name">
                    <input type="hidden" id="prlist-id" name="prlist-id" value="<?php echo $id?>">
                    <input type="hidden" id="employee-id-edit" name="employee-id">
                    <input type="hidden" name="prslist-type" value="<?php echo $prlistType; ?>">    
            
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="submit-edit" class="btn btn-primary" name="editbtn">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>