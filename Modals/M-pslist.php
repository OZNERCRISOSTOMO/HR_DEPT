<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Generate Payslip</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="makepdf.php" method="post" class="offset-md-3 col-md-6" id="myForm">
                <p>Fill out the form to generate payslip into PDF</p>

                <div class="row mb-2">
                    <div class="col-md-6" >
                         
                            <select id='select-employee' name="employee-id" class="select2-container">
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
                        <input type="text" name="position" placeholder="Position" class="form-control" id="position" required>
                    </div>

                </div>

                <div class="mb-2">
                <input type="text" name="branch" placeholder="Branch" class="form-control" id="branch" required>
                </div>

                <div class="mb-2">
                <input type="text" name="department" placeholder="Department" class="form-control" id="department" required>
                </div>

                <div class="mb-2">
                <input type="email" name="email" placeholder="Email" id="email" class="form-control" required>
                </div>

                <?php
                        $prlist = $payslip->payrollDetails($id);
                        ?>
                        <?php foreach($prlist as $list): ?>
                <div class="mb-2">
                <p>From Date: </p>
                <input type="date" name="date-from" id="date-from" class="form-control" placeholder="From" value="<?php echo $list['start']; ?>"required>
                </div> 

                <div class="mb-2">
                <p>To Date: </p>
                <input type="date" name="date-to" id="date-to" class="form-control" placeholder="To" value="<?php echo $list['end']; ?>" required>
                </div>

                        <?php endforeach; ?>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="   number" name="present" id="present" placeholder="Number of hour present" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="overtime" id="overtime" placeholder="Number of Overtime (per hour)" class="form-control" required>
                    </div>
                </div>

                 <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="number" name="food-allowance" id="food-allowance" placeholder="Food allowance" class="form-control" value="0">
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="transpo-allowance" id="transpo-allowance" placeholder="Transportation allowance" class="form-control" value="0">
                    </div>
                </div>
                
                <div class="mb-2">
                <input type="number" name="salary" id="salary" placeholder="Salary" class="form-control" required>
                </div>

                <div class="deductions">
                    <p><b>Membership/Beneficiaries:</b></p>
                        <input type="checkbox" id="sss" name="sss" value="0.04">
                            <label for="beneficiaries1">SSS Beneficiaries</label><br>
                        <input type="checkbox" id="pagibig" name="pagibig" value="0.02">
                            <label for="beneficiaries2">Pag Ibig Beneficiaries</label><br>
                        <input type="checkbox" id="philhealth" name="philhealth" value="0.05" >
                            <label for="beneficiaries3">Philhealth Beneficiaries</label><br /><br />
                </div>
                    <input type="hidden" id="employee-name" name="employee-name">
                    <input type="hidden" id="prlist-id" name="prlist-id" value="<?php echo $id?>">
                    <input type="hidden" id="employee-id" name="employee-id">
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>