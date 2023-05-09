<html>
    <head>
        <title></title>
</head>
<body>
    <h5 id="s">HAHAHAHAH</h5>
    <?php 
    $timezone = 'Asia/Manila';
    date_default_timezone_set($timezone);
    $dateString = date('Y-m-d');
    $month = date('m', strtotime($dateString));
    $backup_file = "u839345553_SBIT3G_".$month.".sql";

    echo $backup_file;
    $filePath = '../backups/'.$backup_file.'';
    echo $filePath;
    if (file_exists($filePath)) {
      echo 'File exists!';
    } else {
      echo 'File does not exist.';
    }    
    ?>
</body>
</html>

<script>
    // Define the path to the file you want to check
let filePath = '../backups/u839345553_SBIT3G_04.sql';

// Send a HEAD request to check if the file exists
fetch(filePath, { method: 'HEAD' })
  .then(response => {
    if (response.ok) {
      document.getElementById(s).style.display = "none";
    } else {
        document.getElementById(s).style.display = "none";
    }
  })
  .catch(error => {
    console.error('Error:', error);
  });
</script>