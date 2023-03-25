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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../includes/prnew.js"></script>
</head>
<body>
<div class="container">
 <div class="row">
   <div class="col-sm-8">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <h4>List of Payroll
        <button type="button" data-toggle="modal" data-target="#payroll-modal">Create New</button>
      </h4>
      <div id="payroll-modal" class="modal fade" role="dialog">
	    <div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Add New Payroll</h3>
			</div>
			<form id="prForm" name="payroll" role="form" action="../Functions/admin-payroll.php" method="POST">
				<div class="modal-body">				
					<div class="form-group">
						<label for="code">Payroll Code</label>
						<input type="text" name="code" class="form-control">
					</div>
					<div class="form-group">
						<label for="start">Cut-off Start Date</label>
						<input type="date" name="start" class="form-control">
					</div>
					<div class="form-group">
						<label for="end">Cut-off End Date</label>
						<input type="date" name="end" class="form-control">
					</div>
          <div class="form-group">
						<label for="type">Payroll Type</label>
						<select class="form-control" name="type">  
              <option value="weekly">Weekly</option> 
              <option value="semimonthly">Semi-Monthly</option>  
              <option value="monthly">Monthly</option>    
            </select> 
					</div>				
				</div>
				<div class="modal-footer">					
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-success" id="submit" name="submit">
				</div>
			</form>
		</div>
	</div>
</div>
      <table class="table table-bordered">
       <thead>
         <th>Id</th>
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
      <button onclick="location.href='../admin/pslist.php'" type="button">View</button>
        <button>Edit</button>
        <button>Delete</button>
      </td>
    </tr>
    <?php
      }
    ?>
    </div>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>
</body>
</html>