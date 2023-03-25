<?php
// start session
session_start();


if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $pslist = new Payslip($database);

    
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
    <h4>List of Payslip
      <button onclick="location.href='../Payslip JSPDF/index.php'" type="button">Create New</button>
        </h4>
    <div>
        <h3>Payroll Details</h3>
        Code:
        Start Date:
        End Date:
        Type:
    </div>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead>
         <th>Id</th>
         <th>Date Added</th>
         <th>Employee</th>
         <th>Net</th>
         <th>File</th>
         <th>Action</th>
    </thead>
    <tbody>
    <?php
      $pslist = $pslist->payslipList();
      foreach($pslist as $list){
    ?>
    <tr>
      <td><?php echo $list['id']; ?></td>
      <td><?php echo $list['date']; ?></td>
      <td><?php echo $list['last_name'] . ', ' . $list['first_name']; ?></td>
      <td><?php echo $list['salary']; ?></td>
      <td></td>
      <td>
        <button><i class='fa fa-view'></i> View</button>
        <button><i class='fa fa-edit'></i> Edit</button>
        <button><i class='fa fa-trash'></i> Delete</button>
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