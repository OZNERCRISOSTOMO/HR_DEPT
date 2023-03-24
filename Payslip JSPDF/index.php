<?php
// start session
session_start();


if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $admin = new Admin($database);
    
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate PDF</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">"

        <!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

<!-- jQuery --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <form action="makepdf.php" method="post" class="offset-md-3 col-md-6">
            <h1>Generate Payslip</h1>
            <p>Fill out the form to generate payslip into PDF</p>

            <div class="row mb-2">
                <div class="col-md-6">
                        <!-- Dropdown --> 
                        <select id='select-employee' name="employee-id">
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
                    <input type="text" name="position" placeholder="Position" class="form-control" required>
                </div>

            </div>

            <div class="mb-2">
            <input type="text" name="branch" placeholder="Branch" class="form-control" required>
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
                    <input type="number" name="present" id="present" placeholder="Number of Present" class="form-control" required>
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
                 <button type="submit" class="btn btn-success btn-lg btn block">Generate Payslip</button>
        </form>
    </div>


<script>
        $(document).ready(function(){
  
    // Initialize select2
    $("#select-employee").select2();
    

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