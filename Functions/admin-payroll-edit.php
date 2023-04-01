<?session_start();
if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == 1) {
    require '../Classes/admin.php';
    require '../Classes/database.php';

    $database = new Database();
    $payroll = new Payroll($database);

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $type = $_POST['type'];

        $result = $payroll->updatePayroll($id, $code, $start, $end, $type);

        if ($result) {
            header("Location: ../admin/payroll.php");
        } else {
            $updateMsg = '<div class="alert alert-danger" role="alert">Unable to update payroll.</div>';
        }
    } else {
        $id = $_POST['id'];
        $payroll = $payroll->getPayroll($id);
    }
} else {
    header("Location: ../admin/prlist.php");
}
?>
