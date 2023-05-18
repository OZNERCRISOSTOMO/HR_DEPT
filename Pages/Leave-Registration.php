<?php
    // establish a connection to the MySQL database
    $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

    // check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get all employees
    $getEmployees = "SELECT * FROM employees WHERE status = '1'";
    $result = mysqli_query($conn, $getEmployees);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Create an empty array to store the results
    $employees = array();


    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
    // Fetch and store each row in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
    } else {
        echo "No results found";
    }


    if (isset($_POST['submit'])){
        $name = isset($_POST['employee-name']) ? $_POST['employee-name'] : null;
        $loginID = isset($_POST['loginID']) ? $_POST['loginID'] : null;
        $date_started = isset($_POST['date_started']) ? $_POST['date_started'] : null;
        $date_ended = isset($_POST['date_ended']) ? $_POST['date_ended'] : null;
        $upload = isset($_POST['upload']) ? $_POST['upload'] : null;
        $leave = isset($_POST['leave']) ? $_POST['leave'] : null;
        $department = isset($_POST['department']) ? $_POST['department'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $employeeId =  $_POST['employee-id'];

             //file data
             $fileleave = isset($_FILES['upload']) ? array(
                'fileName' => $_FILES['upload']['name'],
                'fileTmpName' => $_FILES['upload']['tmp_name'],
                'fileSize' => $_FILES['upload']['size'],
                'fileError' => $_FILES['upload']['error'],
                'fileType' => $_FILES['upload']['type'],
            ) : null; 

            // echo $name;
            // echo "</br>";
            //  echo $loginID;
            // echo "</br>";
            //  echo $date_started;
            // echo "</br>";
            //  echo $date_ended;
            // echo "</br>";
            //  echo $leave;
            // echo "</br>";
            //  echo $department;
            // echo "</br>";
            //  echo $description;
            // echo "</br>";
            // echo $employeeId;
            // echo "</br>";

            //check department if has more than 3 leave 
            $select = "SELECT COUNT(department) FROM leave_p WHERE Department = '$department'";
            $result = mysqli_query($conn, $select);
            
            $count = 0;

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $count = $row['COUNT(department)'];
            } else {
                echo "Query failed.";
            }

            if($count >= 3){
                $url = "Leave-registration.php?status=error";
                header("Location: $url");
            }else{
                //   $sql = "INSERT INTO leave ('Name','Type','date_started','date_ended')";
                // $select = "SELECT * FROM employee_login WHERE login_id = '$loginID'";
                // $result = mysqli_query($conn, $select);


                // if (mysqli_num_rows($result) > 0) {
                //     // output data of each row
                //     while ($row = mysqli_fetch_assoc($result)) {
                    
                        //insert details to leave table 
                     // File is valid, proceed with inserting data into the database
                 $sql = "INSERT INTO `leave_p` (Name, Type, date_started, date_ended, employee_id,status,Department,description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                 $stmt = mysqli_prepare($conn, $sql);
                 $status = 0;
                 mysqli_stmt_bind_param($stmt, 'ssssssss', $name, $leave, $date_started, $date_ended, $employeeId, $status,$department,$description);

                if (mysqli_stmt_execute($stmt)) {
                    $url = "Leave-registration.php?status=success";
                    header("Location: $url");
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                        
                        // echo $fileleave['fileName'];
            //         }
            //     } else {
            //         echo "0 results";
            //     }
            }
            
    }

    // Get employee details 
  if (isset($_POST['id'])) {
    $employeeId = $_POST['id'];

    // Get employee details from the database based on the employeeId
    $getEmployee = "SELECT employee_login.*, employee_details.department FROM employee_login 
                    INNER JOIN employee_details ON employee_login.employee_id = employee_details.employee_id
                    WHERE employee_login.employee_id = '$employeeId'";
    $result = mysqli_query($conn, $getEmployee);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Create an empty array to store the employee details
    $employeeData = array();

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Fetch and store the employee details
        $employeeData = mysqli_fetch_assoc($result);
    } else {
        echo "No results found";
    }
    
    // Convert the employeeData array to JSON
    $jsonResponse = json_encode($employeeData);

    if ($jsonResponse === false) {
        // JSON encoding failed
        die("Error encoding JSON response");
    }

    header('Content-Type: application/json');
    echo $jsonResponse;
    exit; // Make sure to exit after sending the JSON response
}



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
        <!-- Select2 CSS --> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
    <!-- jQuery --> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <!-- Select2 JS --> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
  <body>

    <div class="container col-7   shadow-lg mt-4 mb-4">

    
        <h3 class="text-center pt-4">Leave Registration</h3>

        <form method="POST" action="Leave-Registration.php" enctype="multipart/form-data">

        <div class="container col-10">
            <div class="row">
        <div class=" col-6 mb-3">
            <label for="select-employee" class="form-label">Name:</label>
             <select id='select-employee' name="employee-name" class="select2-container col-11">
                                <option value="0">Select employee</option>
                 <?php
  
                     foreach($employees as $employee){
    echo "<option value='" . $employee['first_name'] . " " . $employee['last_name'] . "' data-employee-id='" . $employee['id'] . "'>" . $employee['first_name'] . " " . $employee['last_name'] . "</option>";
                    }
                ?>          
            </select>
        </div>

        <div class="col-6 mb-3">
            <label for="loginID-disabled" class="form-label">Login ID:</label>
            <input type="text" class="form-control" id="loginID-disabled" name="loginID-disabled" aria-describedby="nameHelp" disabled>
            <input type="hidden" class="form-control" id="loginID" name="loginID" aria-describedby="nameHelp">
        </div>

        <div class="col-6 mb-3">
            <label for="exampleInputname1" class="form-label">Date Started:</label>
            <input type="date" class="form-control" id="date-started" name="date_started" aria-describedby="nameHelp">
        </div>

        <div class="col-6 mb-3">
            <label for="exampleInputname1" class="form-label">Date Ended:</label>
            <input type="date" class="form-control" id="date-ended" name="date_ended"aria-describedby="nameHelp">
        </div>


    
        <div class="mb-3">
        <label class="form-label" >File Leave:</label>
        <div class="input-group mb-3">
    
        <label class="input-group-text" for="inputGroupFile01">Upload</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="upload"  accept="application/pdf" required>
        </div>


        <div class="col-3 mb-4">
            <div class="form-label">
            <label class="form-check-label" for="inlineRadio1">Type: </label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="leave" id="inlineRadio1" value="Vacation Leave">
            <label class="form-check-label" for="inlineRadio1">Vacation Leave</label>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="leave" id="inlineRadio2" value="Sick Leave">
            <label class="form-check-label" for="inlineRadio2">Sick Leave</label>
            </div>

            </div>


             <div class=" col-6 mb-3">
            <label for="disabled" class="form-label">Department:</label>
             <input type="text" class="form-control" id="department-disabled" name="department-disabled" aria-describedby="nameHelp" disabled>
                <input type="hidden" class="form-control" id="department" name="department" aria-describedby="nameHelp">
        </div>

        <div class="col-6 mb-3">
            <label for="description" class="form-label">Description:</label>
            <input type="text" class="form-control" id="description" name="description" aria-describedby="nameHelp">
        </div>
      
            <div class="col-5">
            <input type="hidden" name="employee-id" id="employee-id">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>

        

                </div>  
                </div>

        </div>
        </div>
        </form>




    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>


<script>
     $('#select-employee').select2();

    $('#select-employee').on('change', function() {
    var selectedOption = $(this).find('option:selected');
    var employeeId = selectedOption.data('employee-id');
    console.log(employeeId);

    $.ajax({
        url: window.location.href, // Use current URL
        type: "POST",
        data: {
            id: employeeId,
        },
        success: function(data) {
            try {
                console.log(data)
                //login id 
                $('#loginID-disabled').val(data.login_id);
                $('#loginID').val(data.login_id);

                //department
                $('#department-disabled').val(data.department);
                $('#department').val(data.department);

                //employee id 
                $('#employee-id').val(data.employee_id)

            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
});

    
//   Get the input element
  var dateStarted = document.getElementById('date-started');
  var dateEnded = document.getElementById('date-ended');

  // Calculate the minimum date
  var currentDate = new Date();
  var minimumDate = new Date(currentDate);
  minimumDate.setDate(currentDate.getDate() + 7); // Add 7 days

  // Set the minimum date for the input
  var minimumDateString = minimumDate.toISOString().split('T')[0];
  dateStarted.setAttribute('min', minimumDateString);
dateEnded.setAttribute('min', minimumDateString);


</script>
</body>
</html>