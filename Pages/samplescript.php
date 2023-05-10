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

    $filePath = '../backups/'.$backup_file.'';
    $currentMonth = date('n');
    echo $currentMonth;
    if($currentMonth % 4 == 0) {
      $backup = 'block';
    }else if(file_exists($filePath)){
      $backup = 'none';
    }else{
      $backup = 'none';
    }
    echo $backup;
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