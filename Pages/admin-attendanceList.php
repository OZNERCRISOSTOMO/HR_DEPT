<?php
// start session
session_start();


if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/employee.php';
    require '../Classes/database.php';

    $database = new Database();
    $attlist = new Employee($database);

    
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
  <style>
    table,th,td{
        border:1px solid black;
        padding: 10px;
        margin: 10px;
    }
    </style>
</head>

<body>
    <h1>Attendance</h1>
    <div>
    <table>
    <tr>
        <th>Id</th>
        <th>Employee Id</th>
        <th>Date</th>
        <th>Time_In</th>
        <th>Status</th>
        <th>Time_out</th>
    </tr>
    <?php
      $attlist = $attlist->attendanceList();
      foreach($attlist as $list){
    ?>
    <tr>
      <td><?php echo $list['id']; ?> </td>
      <td><?php echo $list['employee_id']; ?> </td>
      <td><?php echo $list['date']; ?> </td>
      <td><?php echo $list['time_in']; ?> </td>
      <td><?php echo $list['status']; ?> </td>
      <td><?php echo $list['time_out']; ?> </td>
    </tr>
    <?php
      }
    ?>
    </table>
    </div>
</body>
</html>