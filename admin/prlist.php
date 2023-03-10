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
</head>
<body>
<div class="container">
 <div class="row">
   <div class="col-sm-8">
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead>
         <th>Id</th>
         <th>Date Added</th>
         <th>Code</th>
         <th>Start</th>
         <th>End</th>
         <th>Type</th>
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