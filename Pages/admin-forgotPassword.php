<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Forgot password</h1>

    <form action="../Functions/admin-confirmEmail.php" method="POST">
        <input type="email" placeholder="Input email" name="email" required>
        <input type="submit" name="submit" value="Confirm email"> 
    </form>


</body>
</html>