<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<div class="modal fade" id="absentModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel1">Presents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          <div class="container">
		<h2 class="text-center py-2">Attendance Monitoring</h2>
		<table class="table table-striped">
			<thead>
				<tr>
					
			<th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Status</th>
        
          
				</tr>
			</thead>
			<tbody>
            <?php
            $employee = $admin->selectEmployeeSched('1');

            $count = 0;
            foreach ($employee as $sched) {
                foreach ($sched as $key => $value) {

                //check in attendance if exist 
                $valueEmployee = $admin->checkAttendance($value);

                if(!$valueEmployee){
                    $count++;
                    $employeeInfo = $admin->findEmployeeById($value);
              if (!empty($employeeInfo)) {
                echo "<tr><td>".$employeeInfo[0]['id']."</td>";
                echo "<td>".$employeeInfo[0]['first_name']."</td>";
                echo "<td>".$employeeInfo[0]['last_name']."</td>";
                echo '<td><span class="badge badge-danger">Absent</span></td>';
                echo "</br>";
                }
            }

    }
}
?>
			</tbody>
		</table>
	</div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>