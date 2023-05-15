 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<div class="modal fade" id="WarningModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel1">Warnings</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <div class="modal-body">
            
            <div class="container">
      <h2 class="text-center py-2">Attendance Monitoring</h2>
      <table class="table table-striped" id="warning">
        <thead>
          <tr>
            
        <th>Employee ID</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Department</th>
        <th>Warnings</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // establish a connection to the MySQL database
            $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

            // check if connection was successful
             if (!$conn) {
               die("Connection failed: " . mysqli_connect_error());
            }

            $employeeQuery = "SELECT employees.*, employee_details.department FROM employees JOIN employee_details ON employees.id = employee_details.employee_id WHERE employees.status = '1'";
            $employeeResult = $conn->query($employeeQuery);



            // Step 3: Loop through each employee id and get the count of absent days
            while ($idRow = $employeeResult->fetch_assoc()) {
            // Get the employee id
            $employee_id = $idRow["id"];

            // Execute the SQL query to count absent days for this employee
            $countQuery = "SELECT COUNT(status) as count FROM attendance WHERE employee_id = '$employee_id' AND status = 'ABSENT'";
            $countResult = $conn->query($countQuery);

            // Get the count of absent days
            $countRow = $countResult->fetch_assoc();
            $count = $countRow["count"];
              
            if ($idRow['department'] == "human-resource"){
              $dept = "Human Resource";
            }
            else if($idRow['department'] == "sales"){
              $dept = "Sales";
            }
            else if($idRow['department'] == "warehouse"){
              $dept = "Warehouse";
            }
            else 
            {
              $dept = "Purchaser";
            }

            if($count >= 7){
              echo "<tr><td>".$employee_id."</td>";
              echo "<td>".$idRow['first_name']."</td>";
              echo "<td>".$idRow['last_name']."</td>";
              echo "<td>".$dept."</td>";
              echo '<td><span class="badge text-bg-danger">Suspended</span></td></tr>';
              
            }else if($count >= 5){
              echo "<tr><td>".$employee_id."</td>";
              echo "<td>".$idRow['first_name']."</td>";
              echo "<td>".$idRow['last_name']."</td>";
              echo "<td>".$dept."</td>";
              echo '<td><span class="badge text-bg-warning">Written</span></td></tr>';
            }elseif($count >= 3){
              echo "<tr><td>".$employee_id."</td>";
              echo "<td>".$idRow['first_name']."</td>";
              echo "<td>".$idRow['last_name']."</td>";
              echo "<td>".$dept."</td>";
              echo '<td><span class="badge text-bg-success">Verbal</span></td></tr>';
            }
            }

$conn->close();
?>
        </tbody>
      </table>
    </div>
  
            </div>
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
    $('#warning').DataTable();
  });

 
  
  
  
  </script>