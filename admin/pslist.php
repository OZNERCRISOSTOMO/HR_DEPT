<?php
session_start();

if (isset($_SESSION['admin_id'])) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $admin = new Admin($database);
    $payslip = new Payroll($database);

     //get admin data 
    $adminData = $admin->getAdminById($_SESSION['admin_id']);
    $id = $_GET['id'];
} else {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <Title> Payslip List</Title>
    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
     <!-- SWEET ALERT -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!--DATATABLES -->
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <style>
     .modal-backdrop.show {
    z-index: 100;
}

.modal {
  z-index: 150;
}
        .select2-container {
            /* z-index: 20; */
              z-index: 1050;
        }
        /* .select2-selection {
  z-index: auto;
} */
  
    </style>

</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
<div class="container-fluid">
<div class="row">


<!----------SIDEBAR ------------>
<div class="col-2 p-0 ">
<?php include("../Components/Sidebar-Left.php")?>
</div>
<!----------END OF SIDEBAR ------------>


<!----------------Main Content--------------->
<div class="col-xl-9 py-4">
<!--Time and Date-->
<div class="container-fluid d-flex justify-content-center align-items-center mt-6">
                <h5 style="font-weight:bolder;"> 
                <script>                   
                    function updateTime() {
                    const now = new Date();
                    const date = now.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                    const time = now.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
                    document.getElementById('datetime').textContent = `${date} ${time}`;
                    }

                    setInterval(updateTime, 1000);

                </script> 
                <span id="datetime"></span>  
                </h5>  
            </div>
            <!------End----->

<div class="container">
        <div class="row">
            <div class="col-xl-12 mt-3 ">

            
              
                <div class="row d-flex ">

                            <div class="col-7">
                            <h3 >Payroll Details</h3>
                    </div>

                <div class="col-2 " style=" justify-content: flex-end;">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-plus fs-6"></i>Create New</button>
                     <?php include("../Modals/M-pslist.php")?>   
                     <?php include("../Modals/M-pslist-edit.php")?> 
                </div>
                    
                <div class="col-3 " >

                    <form action ="function.php" method="POST">
                        <input type="hidden" name="prlist-id" value="<?php echo $id ?>">
                        
                        <button type="submit" name="submit-generate" class="btn btn-success">
                            Generate Payslip
                        </button>
              
                    </form>
                </div>

                <div class="col-2 ">
                    <form action="sendEmail.php" method="POST">
                        <input type="hidden" name="prlist-id" value="<?php echo $id ?>">

                        <button type="submit" name="submit-sendEmail" class="btn btn-success w-100" >Send To Email</button>
                    </form>
                </div>

                
                <div class="container-fluid mb-3 mt-3">
                <?php
                        $prlist = $payslip->payrollDetails($id);
                    ?>
                    <?php foreach($prlist as $list):?>
                  
                       <div class="container-fluid order-last align-item-end justify-content-end"> 
                        <div class="row" style="display: flex; justify-content: flex-end;">
                        
                        <div class="col-3">
                            <div class="btn btn-md shadow-sm btn-light w-100  text-black">  Code: <?php echo $list['code']; ?></div>
                            </div>

                            <div class="col-3">
                            <div class="btn btn-md shadow-sm  btn-light w-100  text-black"> Type: <?php echo $list['type']; ?></div>
                        </div>

                    <div class="col-3">
                    <div class="btn btn-md  shadow-sm btn-light w-100 text-black"> Start Date: <?php echo $list['start']; ?></div>
                    </div>
                    <div class="col-3">
                    <div class="btn btn-md shadow-sm btn-light w-100  text-black"> End Date: <?php echo $list['end']; ?></div>
                    
                    </div>
                    </div>
                    </div>


                    <?php endforeach; ?>
                    </div>
            </div>

                    </div>        

                    <div>
                    
                    
                
  <!-- TABLE -->                  
                    <div class= "a">          
                         <table id="pslist" class="table table-borderless table-striped text-center mt-3 align-middle">
                         <thead>
                         <tr>
                            <th>Id</th>
                            <th>Date Added</th>
                            <th>Employee</th>
                            <th>Net</th>
                            <th>File</th>
                            <th>Payroll ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                     <tbody>
                        <?php
                            
                            $pslist = $payslip->payslipList($id);
                            if (!empty($pslist)){
                        ?>
                            <?php foreach($pslist as $list) { ?>
                            <tr>
                                <td><?php echo $list['id']; ?></td>
                                <td><?php echo $admin->formatDate($list['date_added']); ?></td>
                                <td><?php echo $list['employee']; ?></td>
                                <td><?php echo $list['net']; ?></td>
                                <td>
                                    <?php if($list["file_path"] == "Not generated")  {?>
                                             <p><?php echo $list["file_path"] ?></p>
                                           
                                    <?php } else { ?> 
                                    <a href="../Uploads/<?php echo $list['file_path'];?>" target="_thapa">
                                                <?php
                                                

                                                $name = $list['employee'];
                                                $name_parts = explode(" ", $name);
                                                $last_name = array_pop($name_parts);
                                                echo $last_name . " - " . $list['date_added'];

                                                ?>
                                    
                                    </a>     
                                    <?php } ?> 
                                </td>
                                <td><?php echo $list['prlist_id']; ?></td>

                                <td>
                                    <div class="row">
                                        <div class="col-3 ps-1">
                                         <?php if($list["file_path"] != "Not generated"){ ?>
                                        <a href="../Uploads/<?php echo $list['file_path'];?>" target="_thapa" style="color: white; text-decoration: none;">
                                        <button  type="button" class="btn btn-sm btn-primary" >
                                            View
                                        </button>
                                        </a>
                                        <?php } ?>
                                </div>
                                <div class="col-3 px-2">
                                <button id="editButton" class="btn btn-sm btn-success editButton" data-bs-toggle="modal" data-employee-id="<?php echo $list["employee_id"] ?>"
                                 data-bs-target="#staticBackdrop-edit" type="submit" name="edit" value="Edit">
                                    Edit
                                </button>
                                </div>
                                <div class="col-3  px-2">
                                <form method="POST" action="../Functions/admin-payslipform-delete.php">
                                    <button class="btn btn-sm btn-danger"  type="submit" name="delete" value="Delete">Delete</button>
                                    <input type="hidden" name="pslist-id" value="<?php echo $list['id']; ?>">  
                                    <input type="hidden" name="prlist-id" value="<?php echo $id ?>">                              
                                </form>
                                </div>
                                    </div>
                                </td>
                            </tr>
                            <?php }
                            } ?>
               
                        </tbody>
                    </table>
                </div>
            </div>
            
             
       
<!-- END OF TABLEE -->
</div>

</div>

<script>
 $(document).ready(function(){
    $('#pslist').DataTable();
  });


  </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const editBtns = document.querySelectorAll(".editButton");
    const id = urlParams.get('id');
    const status = urlParams.get('status');

    //SWEET ALERT DELETED, CREATE , GENERATE
if (status === "deleted" || status === "created" || status === "generated") {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: "success",
    title: `${status} Succesfully!`,
  });
}

    // EDIT PAYSLIP
    editBtns.forEach(function(editBtn) {
  editBtn.addEventListener("click",function(e){
    $('#select-employee-edit').select2();

    // Get the employee id 
    const employeeId = this.getAttribute("data-employee-id")

    // Set the selected value of the dropdown
    $('#select-employee-edit').val(employeeId).trigger('change');
        
    console.log(employeeId);
  });
});

  // Edit modal 
    $('#select-employee-edit').on('change', function() {
      const selectedValue = $(this).val();
      
        if(selectedValue != '0'){
             $.ajax({
                  url: "../Functions/admin-payslip.php",
                  type: "POST",
                  data: {
                      id: selectedValue
                  },

                  success: function(data) {
                      const [employeeData] = JSON.parse(data)
                      
                      $("#employee-id-edit").val(employeeData.employee_id)
                      $("#department-edit").val(employeeData.department)
                      $("#salary-edit").val(employeeData.rate_per_hour)
                       $("#email-edit").val(employeeData.email)
                       $("#position-edit").val(employeeData.position)
                       $("#branch-edit").val(employeeData.branch)
                       $("#present-edit").val(employeeData.num_hr)
                       $("#overtime-edit").val(employeeData.over_time)
                       $("#food-allowance-edit").val(employeeData.food_allowance)
                       $("#transpo-allowance-edit").val(employeeData.transpo_allowance)

                      $("#employee-name-edit").val(employeeData.first_name + " " + employeeData.last_name)
                       const beneficiaries = [{type:"sss-edit",
                                               value:employeeData.sss
                                              },
                                              {type:"pagibig-edit",
                                               value:employeeData.pagibig
                                              },
                                              {type:"philhealth-edit",
                                               value:employeeData.philhealth
                                              }]

                      beneficiaries.forEach(membership =>{
                          if(membership.value != null){
                             $(`#${membership.type}`).prop('checked', true);
                          }else{
                              $(`#${membership.type}`).prop('checked', false);
                          }
                      })
                
                  }
              })
      }
    });
 





    const modalSubmitBtn = document.querySelector('#staticBackdrop button[type="submit"]');
        modalSubmitBtn.addEventListener('click', () => {
        const myForm = document.querySelector('#myForm');
        myForm.submit();
    });

$('#staticBackdrop').on('shown.bs.modal', function() {
  $('#select-employee').select2();
  $('#select-employee-edit').select2();
});

    $(document).ready(function(){
  
  // Initialize select2
  $('#select-employee').select2();
  

  // Create new modal
  $('#select-employee').on('change', function() {
      var selectedValue = $(this).val();
    //   console.log(selectedValue);
      if(selectedValue != '0'){
             $.ajax({
                  url: "../Functions/admin-payslip.php",
                  type: "POST",
                  data: {
                      id: selectedValue
                  },

                  success: function(data) {
                      const [employeeData] = JSON.parse(data)
                      
                      $("#employee-id").val(employeeData.employee_id)
                      $("#department").val(employeeData.department)
                      $("#salary").val(employeeData.rate_per_hour)
                       $("#email").val(employeeData.email)
                       $("#position").val(employeeData.position)
                       $("#branch").val(employeeData.branch)
                       $("#present").val(employeeData.num_hr)
                       $("#overtime").val(employeeData.over_time)
                       $("#food-allowance").val(employeeData.food_allowance)
                       $("#transpo-allowance").val(employeeData.transpo_allowance)

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
                
                  }
              })
      }
      
      });
  });

  
</script>

<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</div>
</html>
