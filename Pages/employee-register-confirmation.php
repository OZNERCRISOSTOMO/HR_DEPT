<?php

//if no success in url, redirect to employee-register
if(!isset($_GET["success"])){
    header("Location: employee-register.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Register Confirmation</title>
</head>
<body>
    <h1>Your application has been submitted, we will notify you.</h1>
</body>
</html>