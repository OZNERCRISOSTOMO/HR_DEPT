<?php
session_start();

if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $admin = new Admin($database);
    $payslip = new Payroll($database);
    $id = $_GET['id'];
} else {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>

    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">


    <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <style>
        .select2-container {
            z-index: 9999;
        }
    </style>
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h4>List of Payslip</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create New</button>
                    <!-- <button type="submit" class="btn btn-success btn block" id="generate-payslip">Generate Payslip</button> -->
                    <a href="function.php">Generate</a>
                <div>
                    <h3>Payroll Details</h3>
                    <?php
                        $prlist = $payslip->payrollDetails($id);
                    ?>
                    <?php foreach($prlist as $list):?>
                    Code: <?php echo $list['code']; ?>
                    Start Date: <?php echo $list['start']; ?>
                    End Date: <?php echo $list['end']; ?>
                    Type: <?php echo $list['type']; ?>
                    <?php endforeach; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Date Added</th>
                            <th>Employee</th>
                            <th>Net</th>
                            <th>File</th>
                            <th>Payroll ID</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $pslist = $payslip->payslipList($id);
                            if (!empty($pslist)):
                        ?>
                            <?php foreach($pslist as $list):?>
                            <tr>
                                <td><?php echo $list['id']; ?></td>
                                <td><?php echo $list['date_added']; ?></td>
                                <td><?php echo $list['employee']; ?></td>
                                <td><?php echo $list['net']; ?></td>
                                <td><?php echo $list['file_path']; ?></td>
                                <td><?php echo $list['prlist_id']; ?></td>
                                <td>
                                    <button>View</button>
                                    <button>Edit</button>
                                    <button>Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No data found.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>


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
                    <div class="col-md-6">
                         
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
                <input type="email" name="email" placeholder="Email" id="email" class="form-control" required>
                </div>

                <div class="mb-2">
                <p>From Date: </p>
                <input type="date" name="date-from" id="date-from" class="form-control" placeholder="From" required>
                </div> 

                <div class="mb-2">
                <p>To Date: </p>
                <input type="date" name="date-to" id="date-to" class="form-control" placeholder="To" required>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="number" name="present" id="present" placeholder="Number of hour present" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <input type="number" name="overtime" placeholder="Number of Overtime (per hour)" class="form-control" required>
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
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
    <!---------------------- END OF MODAL FOR PAYSLIP FORM ------------------------------------->
</div>

  
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    console.log(id);

    const modalSubmitBtn = document.querySelector('#staticBackdrop button[type="submit"]');
        modalSubmitBtn.addEventListener('click', () => {
        const myForm = document.querySelector('#myForm');
        myForm.submit();
    });

$('#staticBackdrop').on('shown.bs.modal', function() {
  $('#select-employee').select2();
});

    $(document).ready(function(){
  
  // Initialize select2
  $('#select-employee').select2();
  

  // Read selected option
  $('#select-employee').on('change', function() {
      var selectedValue = $(this).val();
      console.log(selectedValue);
      if(selectedValue != '0'){
             $.ajax({
                  url: "../Functions/admin-payslip.php",
                  type: "POST",
                  data: {
                      id: selectedValue
                  },

                  success: function(data) {
                      const [employeeData] = JSON.parse(data)
                      $("#salary").val(employeeData.salary)
                       $("#email").val(employeeData.email)
                       $("#position").val(employeeData.position)
                       $("#branch").val(employeeData.branch)
                      $("#employee-name").val(employeeData.first_name + " " + employeeData.last_name)
                       const beneficiaries = [{type:"sss",
                                               value:employeeData.sss
                                              },
                                              {type:"pagibig",
                                               value:employeeData.pagibig
                                              },
                                              {type:"philhealth",
                                               value:employeeData.philhealth
                                              }]
                      beneficiaries.forEach(membership =>{
                          if(membership.value != null){
                             $(`#${membership.type}`).prop('checked', true);
                          }else{
                              $(`#${membership.type}`).prop('disabled', true);
                          }
                      })
                       console.log(beneficiaries)
                  }
              })
      }
      
      });
  });
</script>
</body>
</html>

