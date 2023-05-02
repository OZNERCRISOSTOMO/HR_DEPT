<?php
    // establish a connection to the MySQL database
    $conn = mysqli_connect("sql985.main-hosting.eu", "u839345553_sbit3g", "sbit3gQCU", "u839345553_SBIT3G");

    // check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])){
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $loginID = isset($_POST['loginID']) ? $_POST['loginID'] : null;
        $date_started = isset($_POST['date_started']) ? $_POST['date_started'] : null;
        $date_ended = isset($_POST['date_ended']) ? $_POST['date_ended'] : null;
        $upload = isset($_POST['upload']) ? $_POST['upload'] : null;
        $leave = isset($_POST['leave']) ? $_POST['leave'] : null;

             //file data
             $fileleave = isset($_FILES['upload']) ? array(
                'fileName' => $_FILES['upload']['name'],
                'fileTmpName' => $_FILES['upload']['tmp_name'],
                'fileSize' => $_FILES['upload']['size'],
                'fileError' => $_FILES['upload']['error'],
                'fileType' => $_FILES['upload']['type'],
            ) : null; 

            //   $sql = "INSERT INTO leave ('Name','Type','date_started','date_ended')";
                $select = "SELECT * FROM employee_login WHERE login_id = '$loginID'";
                $result = mysqli_query($conn, $select);


                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                    
                        //insert details to leave table 
                     // File is valid, proceed with inserting data into the database
                 $sql = "INSERT INTO `leave` (Name, Type, date_started, date_ended, employee_id, leave_file,status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
                 $stmt = mysqli_prepare($conn, $sql);
                 $status = "pending";
                 mysqli_stmt_bind_param($stmt, 'sssssss', $name, $leave, $date_started, $date_ended, $row['employee_id'], $fileleave['fileName'], $status);

                if (mysqli_stmt_execute($stmt)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . mysqli_error($conn);
                }

                        
                        // echo $fileleave['fileName'];
                    }
                } else {
                    echo "0 results";
                }


    }



?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>

    <div class="container col-7   shadow-lg mt-4 mb-4">

    
        <h3 class="text-center pt-4">Leave Registration</h3>

        <form method="POST" action="Leave-Registration.php" enctype="multipart/form-data">

        <div class="container col-10">
            <div class="row">
        <div class=" col-6 mb-3">
            <label for="exampleInputname1" class="form-label">Name:</label>
            <input type="text" class="form-control" id="exampleInputname1" name="name" aria-describedby="nameHelp">
        </div>

        <div class="col-6 mb-3">
            <label for="exampleInputname1" class="form-label">Login ID:</label>
            <input type="text" class="form-control" id="exampleInputname1" name="loginID" aria-describedby="nameHelp">
        </div>

        <div class="col-6 mb-3">
            <label for="exampleInputname1" class="form-label">Date Started:</label>
            <input type="date" class="form-control" id="exampleInputname1" name="date_started" aria-describedby="nameHelp">
        </div>

        <div class="col-6 mb-3">
            <label for="exampleInputname1" class="form-label">Date Ended:</label>
            <input type="date" class="form-control" id="exampleInputname1" name="date_ended"aria-describedby="nameHelp">
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


            <div class="col-3 mb-3">
            <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   Department
                </a>

                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">HR</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </div>

            </div>
      
            <div class="col-5">
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
</body>
</html>