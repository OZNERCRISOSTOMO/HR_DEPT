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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
<div class="container">
 <div class="row">
   <div class="col-sm-8">
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
       <tr>
         <th>Id</th>
         <th>Date Added</th>
         <th>Employee</th>
         <th>Net</th>
         <th>File</th>
         <th>Action</th>
    </tr>
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
        <button></i> View</button>
        <button></i> Edit</button>
        <button></i> Delete</button>
      </td>
    </tr>
    <?php
      }
    ?>
     </table>
   </div>
</div>
</div>
</div>
</body>
</html>