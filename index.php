<?php
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
        <h1> LOGIN </h1>
        <form action="Functions/admin-login.php" method="POST">
            <input type="text" placeholder="Email" name="email">
            <input type="password" name="password">
            <button>Log in</button>
            
        </form>
       
            <?php
                if (isset($_GET["error"])) {

                    if ($_GET["error"] == "errorPassword") {
                        echo '<p class=""> Wrong password!</p>';
                    } else if ($_GET["error"] == "errorEmail") {
                        echo '<p class=""> Email does not exist!!</p>';
                    }else if ($_GET["error"] == "emptyInput") {
                        echo '<p class=""> Empty Input</p>';
                    }
                }
             
            ?> 
</body>
</html>