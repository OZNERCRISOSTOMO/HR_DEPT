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
    <Title> PAYSLIP LIST </Title>
    <!-- BOOSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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
            <div class="col-xl-12">
                <h4>List of Payslip</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create New</button>
                     <?php include("../Modals/M-pslist.php")?>   

                    
                    <a href="function.php">
                     <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#PayrollModal">Generate Payslip</button>
                    </a>
                    
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
                
  <!-- TABLE -->                  
                    <div class= "a">          
    <table class="table table-borderless table-striped text-center mt-3 align-middle">
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
      <form method="POST">
      <button onclick="location.href='../admin/pslist.php?id=<?php echo $list['id']?>'" type="button" class="btn btn-sm btn-primary">View</button>
      <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#EditModal" type="submit" name="edit" value="Edit">Edit</button>
      <button class="btn btn-sm btn-danger"  type="submit" name="delete" value="Delete">Delete</button>
      </form>
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
       
<!-- END OF TABLEE -->
</div>

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
</div>
</html>

