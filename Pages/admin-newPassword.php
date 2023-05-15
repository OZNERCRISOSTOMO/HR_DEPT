<?php
    $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>New password</h1>
    <form action="../Functions/admin-newPassword.php" method="POST">
        <input type="password" placeholder="New password" name="password" required>
        <input type="password" placeholder="Confirm password" name="new-password" required>
        <input type="hidden" name="employee-id" value="<?php echo $id; ?>">
        <button type="submit" name="submit-password"> Submit</button>
    </form>
</body>
</html>