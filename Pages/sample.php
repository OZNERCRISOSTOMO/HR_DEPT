<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../Functions/Attendance.php" method="post">
        <input type="text" name="card-number" id="card-number" autofocus required>
        <button type="submit" id="submit-btn" name="submit"></button>

    </form>

    <script>
        const card = document.getElementById ('card-number');
        const submit = document.getElementById ('submit-btn');
            window.addEventListener("pageshow", function(event) {
                var input = document.getElementById("card-number");
                input.value = "";
         });

        card.addEventListener('input', function()
         {
            if (card.value) {
                button.disabled = false;
            }
            else {
                button.disabled = true;
            }
        })
    </script>
</body>
</html>
<?php

?>