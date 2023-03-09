<?php
// start session
session_start();


if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $admin = new Admin($database);

    
} else {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<body>
<div>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <th>#</th>
                  <th>Date added</th>
                  <th>Code</th>
                  <th>Start</th>
                  <th>End</th>
                  <th>Type</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();
                        echo "
                          <tr>
                            <td>".$row['id']."</td>
                            <td>".date('M d, Y', strtotime($row['created_on']))."</td>
                            <td>""</td>
                            <td>""</td>
                            <td>""</td>
                            <td>
                                <ul class='dropdown-menu'>
                                    <li class='dropdown'>
                                    <p>Action</p>
                                    </li>
                                    <li>
                                    <a href='#' data-toggle='modal' class='btn btn-info btn-sm btn-flat'><i class='fa fa-eye'></i>View</a>
                                    </li>
                                    <li>
                                    <a href='#' data-toggle='modal' class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i>View</a>
                                    </li>
                                    <li>
                                    <a href='#' data-toggle='modal' class='btn btn-danger btn-sm delete btn-flat'><i class='fa fa-trash'></i>View</a>
                                    </li>
                                </ul>
                            </td>
                          </tr>
                        ";
                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
</body>
</html>