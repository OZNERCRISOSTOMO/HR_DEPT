<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../Images/Logo 1.svg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password?</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">


        <div class="container col-7 shadow  bg-white p-5 rounded">
       <div class="text-center mb-3"> <i class="fa-solid fa-lock" style="font-size: 120px;"></i></div>
<h3 class="mb-2 text-center">Forgot Your password?</h3>
<p class="px-5 text-muted mb-4 text-center">Enter the email associated with your account and we will give you a new password.</p>

<form action="../Functions/admin-confirmEmail.php" method="POST" >
    <label for="exampleInputEmail1" class="form-label">Email Address:</label>
    <input class="form-control mb-2 " type="email" placeholder="Input email" name="email" required stlye="width: 100px;" autocomplete="off">
    
    <input class="btn btn-primary w-100 shadow" type="submit" name="submit" value="Confirm email" data-bs-toggle="modal" data-bs-target="#forget"> 
    
</form>
</diV>
</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>