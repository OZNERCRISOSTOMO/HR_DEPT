<?php
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset your password</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body  style="background-color: #f2f2f2; font-family: Bahnschrift;">

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">


<div class="container col-7 shadow  bg-white px-3 py-4 rounded">

<div class="row">
    <div class="col-5 text-center py-4">
    <i class="fa-solid fa-key pb-4" style="font-size: 90px;"></i>
    <h5>Create new Password</h5>
    <p class="text-muted">Your new password must be different from previous used passwords.</p>
</div>
<div class="col-7">
    <h3 class="text-center">Reset your password</h3>
    <form action="../Functions/admin-newPassword.php" method="POST">
        <div class="mb-3">
        <label  class="form-label">New Password:</label>
        <input class="form-control" type="password" placeholder="New password" name="password" required>
        <div  class="form-text">Must be at Least 8 characters.</div>
        </div>
        <div class="mb-3">
        <label  class="form-label">Confirm Password:</label>
        <input class="form-control" type="password" placeholder="Confirm password" name="new-password" required>
        <div  class="form-text">Both Password must match.</div>   
    </div>

        <input type="hidden" name="employee-id" value="<?php echo $id; ?>">
        <button class="btn btn-primary w-100" type="submit" name="submit-password"> Submit</button>
    </form>
</div>
</div>

</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>