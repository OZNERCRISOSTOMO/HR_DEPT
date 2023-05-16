<?php
// start session
session_start();
if (isset($_SESSION['admin_id'])) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $prlist = new Payroll($database); 
    $admin = new Admin($database);

       //get admin data 
    $adminData = $admin->btnPic($_SESSION['admin_id']);
} else {
    header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
<Title> Payroll List </Title>
<link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    <!--DATATABLES -->
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
<div class="container-fluid">
  <div class="row">
    <!---Left Side Bar--->
    <div class="col-xl-2 p-0">
      <?php include("../Components/Sidebar-Left.php")?>
    </div>

    <!----------------Main Content--------------->
    <div class="col-xl-9">
      <!--Time and Date-->
      <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
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

      <div class="container-fluid ms-3">
        <!--Create New Button-->
        <div class="container ">
          <?php echo $deleteMsg??''; ?>
          <div class="row mt-2 mb-3">
            <div class="col-2">
            <h4 class="fw-bolder">Payroll List</h4>
            </div>
            <div class="col-2"> 
              <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#PayrollModal"><i class="fa-solid fa-plus"></i> Create New</button>
            
            </div>

            <div class="col-2"> 
              
              <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
              List of Archive
            </button>

<!-- Modal -->
<div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table id="prlist" class="table table-borderless table-striped text-center mt-3 align-middle">
          <thead>
            <th>ID</th>
            <th>Date Added</th>
            <th>Start</th>
            <th>End</th>
            <th>Type</th>
            <th>Action</th>
          </thead>

          <tbody>
            <?php
              $arlist = $prlist->ArchiveList();
              foreach($arlist as $list){
            ?>
            <tr>
              <td><?php echo $list['id']; ?> </td>
              <td><?php echo $list['date']; ?> </td>
              <td><?php echo $list['start']; ?> </td>
              <td><?php echo $list['end']; ?> </td>
              <td><?php echo $list['type']; ?> </td>
              <td>
             
                <div class="row">
                  <div class="col-3">
              <button onclick="location.href='../Functions/admin-payroll-restore.php?id=<?php echo $list['id']?>'" type="button" class="btn btn-sm btn-primary">Restore</button>
              </div>
              </td>
              </tr>
              <?php
              }
            ?>
             </tbody>
        </table>

      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


            </div>
              </div>
        <!----End---->

        <!---Table--->
        <table id="prlist" class="table table-borderless table-striped text-center mt-3 align-middle">
          <thead>
            <th>ID</th>
            <th>Date Added</th>
            <th>Start</th>
            <th>End</th>
            <th>Type</th>
            <th>Action</th>
          </thead>

          <tbody>
            <?php
              $prlist = $prlist->payrollList();
              foreach($prlist as $list){
            ?>
            <tr>
              <td><?php echo $list['id']; ?> </td>
              <td><?php echo $list['date']; ?> </td>
              <td><?php echo $list['start']; ?> </td>
              <td><?php echo $list['end']; ?> </td>
              <td><?php echo $list['type']; ?> </td>
              <td>
             
                <div class="row">
                  <div class="col-3">
              <button onclick="location.href='../admin/pslist.php?id=<?php echo $list['id']?>&type=<?php echo $list['type']?>' " type="button" class="btn btn-sm btn-primary">View</button>
              </div>
              <div class="col-3 m-0 ps-2">
              <button id="editButton" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#EditModal" type="submit" name="edit" value="Edit">Edit</button>
              </div>
              <div class="col-3 p-0 m-0">
              <form method="POST" action="../Functions/admin-payroll-delete.php">
              <button class="btn btn-sm btn-danger" type="submit" name="archive" class="archive" id="archive">Archive</button>
              <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
              </form>
              </div>
                
              </div>  
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        <!---Table End--->

        <!---Script for edit button--->
          <script>
            // Get all the edit button elements using a class selector
            const editBtns = document.querySelectorAll('#editButton');

            // Loop through all the edit buttons and add an event listener to each one
            editBtns.forEach(function(editBtn) {
              editBtn.addEventListener('click', function(event) {
                // prevent the form from submitting
                event.preventDefault();

                // Get the row data
                var row = $(this).closest("tr");
                var id = row.find("td:eq(0)").text().trim();
                var date = row.find("td:eq(1)").text().trim();
                var start = row.find("td:eq(3)").text().trim();
                var end = row.find("td:eq(4)").text().trim();
                var type = row.find("td:eq(5)").text().trim();

                // Set the modal values
                $("#editId").val(id);
                $("#editDate").val(date);
                $("#editStart").val(start);
                $("#editEnd").val(end);
                $("#editType").val(type);
              });
            });

          </script>

        <!----Modal---->
        <div class="modal fade" id="PayrollModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Add New Payroll</h4>
              </div>
              <div class="modal-body">
                <form id="prForm" name="payroll" role="form" action="../Functions/admin-payroll.php" method="POST">

                  <div class="form-group mb-3">
                    <label for="start" class="fw-bold">Cut-off Start Date</label>
                    <input type="date" name="start" class="form-control shadow-none" id="cut-off-start">
                  </div>

                  <div class="form-group mb-3">
                    <label for="end" class="fw-bold">Cut-off End Date</label>
                    <input type="date" name="end" class="form-control shadow-none"  id="cut-off-end">
                  </div>

                  <div class="form-group mb-3">
                    <label for="type" class="fw-bold">Payroll Type</label>
                      <select class="form-select shadow-none" id="type" name="type">
                        <option value="" selected>Choose an option</option>
                        <option value="semimonthly">Semi-Monthly</option>
                        <option value="monthly">Monthly</option>
                        <option value="custom">Other</option>
                        </select>
                        <!-- Add an input field for the custom option -->
                        <div class="mt-2" id="customTypeContainer" style="display: none;">
                        <select class="form-select shadow-none" id="type2" name="type2">
                        <option value="" selected>Choose an option</option>
                        <option value="resignation">Resignation</option>
                        <option value="termination">Termination</option>
                        </select>
                        
                        </div>
                  </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default text-danger border border-end-0 border-0" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" id="submit" name="submit">
              </div>
              </form>
            </div>
          </div>
        </div>
        <!---Modal End--->

        <!---Modal for Edit--->
        <div class="modal fade" id="EditModal">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h4>Edit Payroll</h4>
              </div>
              <div class="modal-body">
                <form id="prForm" name="payroll" role="form" action="../Functions/admin-payroll-edit.php" method="POST">
                  <div class="form-group mb-3">
                    <input type="hidden" id="editId" name="editId">
                    <label for="editDate">Date</label>
                    <input type="date" class="form-control" id="editDate" name="editDate">
                  </div>
                  <div class="form-group mb-3">
                    <label for="editStart">Start</label>
                    <input type="date" class="form-control" id="editStart" name="editStart">
                  </div>
                  <div class="form-group mb-3">
                    <label for="editEnd">End</label>
                    <input type="date" class="form-control" id="editEnd" name="editEnd">
                  </div>
                  <div class="form-group mb-3">
                    <label for="editType">Type</label>
                    <select class="form-control" id="editType" name="editType">
                    <option value="monthly">Monthly</option>
                    <option value="semimonthly">Semi-Monthly</option>
                        </select>
                        <!-- Add an input field for the custom option -->
                        <div class="mt-2" id="customTypeContainer" style="display: none;">
                          <input type="text" class="form-control" id="customType" name="customType" placeholder="Enter custom type">
                          <button type="button" class="btn btn-primary mt-2" id="saveCustomType">Save Custom Type</button>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger border " data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" id="update" name="editSubmit">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!---Modal End--->

        <!-- JavaScript code to handle the custom option -->

        <script>
 $(document).ready(function(){
    $('#prlist').DataTable();
  });


  </script>
<script>
   const urlParams = new URLSearchParams(window.location.search);
   const status = urlParams.get('status');

     //SWEET ALERT archived , edit , create
if (status === "archived" || status === "created" || status === "generated" || status === "updated") {
    const capitalizedStatus = status.charAt(0).toUpperCase() + status.slice(1); // Uppercase the first letter of status

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
    title: `${capitalizedStatus} Succesfully!`,
  });
}

document.getElementById('type').addEventListener('change', function() {
  var customOption = document.getElementById('type').value;
  var customTypeContainer = document.getElementById('customTypeContainer');
  if (customOption === 'custom') {
    customTypeContainer.style.display = 'block';
    document.getElementById("cut-off-end").disabled = true;
    document.getElementById("cut-off-start").disabled = true;


  } else {
    customTypeContainer.style.display = 'none';
  }
});

document.getElementById('saveCustomType').addEventListener('click', function() {
  var customType = document.getElementById('customType').value;
  if (customType !== '') {
    var select = document.getElementById('type');
    var option = document.createElement('option');
    option.value = customType;
    option.text = customType;
    select.add(option);
    select.value = customType;
    document.getElementById('customType').value = '';
    document.getElementById('customTypeContainer').style.display = 'none';
  }
});

const logoutBtn = document.querySelector(".logout");

  // SWEET ALERT CONFIRMATION FOR LOGOUT
logoutBtn.addEventListener("click", function (e) {
  e.preventDefault();

  Swal.fire({
    title: "Are you sure?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Log me out",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      // e.target.href
      // console.log(e.target.closest(".logout").href)
      window.location.href = `${e.target.closest(".logout").href}`;
    }
  });
});


</script>
<!---Script for custom--->

      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>