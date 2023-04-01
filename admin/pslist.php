<?php
session_start();

if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payslip = new Payroll($database); 
    $id = $_GET['id'];
    $pslist = $payslip->payslipList($id);
} else {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/53a2b7f096.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h4>List of Payslip
                    <button onclick="location.href='../Payslip JSPDF/index.php'" type="button">Create New</button>
                </h4>
                <div>
                    <h3>Payroll Details</h3>
                    Code:
                    Start Date:
                    End Date:
                    Type:
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Date Added</th>
                            <th>Employee</th>
                            <th>Net</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        <?php if (!empty($pslist)): ?>
                            <?php foreach($pslist as $list): ?>
                            <tr>
                                <td><?php echo $list['id']; ?></td>
                                <td><?php echo $list['date_added']; ?></td>
                                <td><?php echo $list['employee']; ?></td>
                                <td><?php echo $list['net']; ?></td>
                                <td><?php echo $list['file_path']; ?></td>
                                <td><?php echo $list['prlist_id']; ?></td>
                                <td></td>
                                <td>
                                    <button>View</button>
                                    <button>Edit</button>
                                    <button>Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No data found.</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

      <form>
        
      </form>
<script>
  const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    console.log(id);
</script>
</body>
</html>

