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
        
        <th>Total Salary</th>
       
        <th>Total Over Time</th>
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
        ?>
      <tr>
      <td><?php echo $employee_row['employee_id']; ?> </td>
      <td><?php echo $employee_row['first_name'];?> <?php echo $employee_row['last_name'];?></td>
      <td><?php echo $employee_row['department']; ?> </td>
      <td><?php echo $employee_row['sick_leave']; ?> </td>
      <td><?php echo $employee_row['vacation_leave']; ?> </td>
      
      <td><?php echo $total_salary; ?> </td>
      
      <td><?php echo $total_overtime; ?> </td>
    </tr>
    <?php
      }
?>
    </tbody>
  </table>










      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>