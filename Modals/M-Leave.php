

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal modal-xl fade" id="leave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Balance</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="overtime" class="table table-striped table-borderless align-middle text-center mb-2">
    <thead>
      <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Department</th>
        <th>Sick Leave</th>
        <th>Vacation Leave</th>
        <th>Maternity Leave</th>
        <th>Paternity Leave</th>

      </tr>
      </thead>
      <tbody>
      <?php 
            $dbServername = "sql985.main-hosting.eu";
            $dbUsername = "u839345553_sbit3g";
            $dbPassword = "sbit3gQCU";
            
            $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
            $timezone = 'Asia/Manila';
            date_default_timezone_set($timezone);
            $date_now = date('Y-m-d');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $employee = "SELECT * FROM employees
            JOIN employee_details ON employee_details.employee_id = employees.id
            ORDER BY employees.id DESC";

            $employee_query = $conn->query($employee);
            while($employee_row = mysqli_fetch_assoc($employee_query)){
              $total_salary = $employee_row['num_hr'] * $employee_row['rate_per_hour'];
              $total_overtime = $employee_row['over_time'] * $employee_row['rate_per_hour'];

            if ($employee_row['department'] == 'human-resource'){
              $dept = "Human Resource";
            }
            else if($employee_row['department'] == 'sales'){
              $dept = "Sales";
            }
            else if($employee_row['department'] == 'purchaser'){
              $dept = "Purchaser";
            }
            else $dept = "Warehouse";
        ?>
      <tr>
      <td><?php echo $employee_row['employee_id']; ?> </td>
      <td><?php echo $employee_row['first_name'];?> <?php echo $employee_row['last_name'];?></td>
      <td><?php echo $dept; ?> </td>
      <td><?php echo $employee_row['sick_leave']; ?> </td>
      <td><?php echo $employee_row['vacation_leave']; ?> </td>
      <td><?php echo $employee_row['maternity_leave']; ?> </td>
      <td><?php echo $employee_row['paternity_leave']; ?> </td>
   
    </tr>
    <?php
      }
?>
    </tbody>
  </table>










      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
 $(document).ready(function(){
    $('#overtime').DataTable();
  });
  </script>