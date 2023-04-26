<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
<div class="modal fade" id="absentModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel1">Absents</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          <div class="container">
		<h2 class="text-center">Attendance Monitoring</h2>
		<table id="attendanceTable" class="table table-striped">
			<thead>
				<tr>
			<th>Employee ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Status</th>
				</tr>
			</thead>
			<tbody>
           
			</tbody>
		</table>
    <script>
      $.ajax({
        url: "../Functions/employee-absent.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
          $.each(data, function(index, value){
            var row = $("<tr>");
            var idCell = $("<td>").text(value.id);
            var fnameCell = $("<td>").text(value.first_name);
            var lnameCell = $("<td>").text(value.last_name);
            var statusCell = $("<td>").text("Absent");
            row.append(idCell, fnameCell, lnameCell, statusCell);
            $("#attendanceTable tbody").append(row);
          });
        }
      });
    </script>
	</div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         
          </div>
        </div>
      </div>
    </div>