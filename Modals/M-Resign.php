<?php

$conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

// check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>


<!-- Modal -->
<div class="modal fade modal-lg" id="Resign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">List of Resigned Employees</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      <table class="table">
  <thead>
    <tr>
      <th scope="col" style="white-space: nowrap;">Employee ID</th>
      <th scope="col">Firstname</th>
      <th scope="col">Lastname</th>
      <th scope="col">Email</th>
      <th score="col" style="white-space: nowrap;">Date Hired</th> 
      <th scope="col" style="white-space: nowrap;">Date Resign</th>
    </tr>
  </thead>
  <tbody>

  <?php 
  $query = "SELECT employees.*, employee_details.date_hired FROM employees JOIN employee_details ON employees.id = employee_details.employee_id WHERE employees.status = '3'";
  $result = $conn->query($query);
  
   while($resign = mysqli_fetch_assoc($result)){

   
  ?>
    <tr>
    <td><?php echo $resign['id']?></td>
      <td><?php echo $resign['first_name']?></td>
      <td><?php echo $resign['last_name']?></td>
      <td><?php echo $resign['email']?></td>
      <td><?php echo $resign['date_hired']?></td>
      <td><?php echo $resign['date_resign']?></td>
    </tr>
   <?php } ?>
  </tbody>
</table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>