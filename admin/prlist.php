<?php
// start session
session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $prlist = new Payroll($database); 
} else {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../includes/prnew.js"></script>
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">

<!--Time and Date-->
  <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
    <h5 style="font-weight:bolder;"> 
      <script>                   
        document.write(new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true, day: 'numeric', month: 'short', year: 'numeric' }).toUpperCase());
      </script>    
    </h5>  
  </div>
  <!------End----->

<!--Create New Button-->
<div class="container">
  <?php echo $deleteMsg??''; ?>
  <h4 class="fw-bolder">Payroll List</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PayrollModal">Create New</button>
    <div class="col-sm input-group w-25 float-end">
      <span class="input-group-text bg-white border border-end-0 border-0">
        <i class="fa-solid fa-magnifying-glass"></i>
      </span>
      <input type="text" class="form-control border-0 border shadow-none border-start-0" id="Search" autocomplete="off">
    </div>
<!----End---->

<!---Table--->
<table class="table table-borderless table-striped text-center mt-3 align-middle">
  <thead>
    <th>ID</th>
    <th>Date Added</th>
    <th>Code</th>
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
      <td><?php echo $list['code']; ?> </td>
      <td><?php echo $list['start']; ?> </td>
      <td><?php echo $list['end']; ?> </td>
      <td><?php echo $list['type']; ?> </td>
      <td>
      <button onclick="location.href='../admin/pslist.php'" type="button" class="btn btn-sm btn-primary">View</button>
      <button class="btn btn-sm btn-success">Edit</button>
      <button class="btn btn-sm btn-danger">Delete</button>
      </td>
    </tr>
    <?php
      }
    ?>
  </tbody>
</table>
<!---Table End--->

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
						<label for="code" class="fw-bold">Payroll Code</label>
						<input type="text" name="code" class="form-control shadow-none">
					</div>

					<div class="form-group mb-3">
						<label for="start" class="fw-bold">Cut-off Start Date</label>
						<input type="date" name="start" class="form-control shadow-none">
					</div>

					<div class="form-group mb-3">
						<label for="end" class="fw-bold">Cut-off End Date</label>
						<input type="date" name="end" class="form-control shadow-none">
					</div>

          <div class="form-group mb-3">
            <label for="type" class="fw-bold">Payroll Type</label>
              <select class="form-select shadow-none" id="type" name="type">
                <option value="" selected>Choose an option</option>
                <option value="weekly">Weekly</option>
                <option value="semimonthly">Semi-Monthly</option>
                <option value="monthly">Monthly</option>
              </select>
          </div>
        </form>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-default text-danger border border-end-0 border-0" data-bs-dismiss="modal">Close</button>
				<input type="submit" class="btn btn-success" id="submit" name="submit">
      </div>
    </div>
  </div>
</div>
<!---Modal End--->

</div>
</body>
</html>