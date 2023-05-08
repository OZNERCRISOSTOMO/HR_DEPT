<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="leave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Balance</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    

        <?php 
            $dbServername = "sql985.main-hosting.eu";
            $dbUsername = "u839345553_sbit3g";
            $dbPassword = "sbit3gQCU";
            
            $conn = new mysqli($dbServername, $dbUsername, $dbPassword, 'u839345553_SBIT3G');
            $timezone = 'Asia/Manila';
            date_default_timezone_set($timezone);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $date_now = date('Y-m-d');
            $sql = "SELECT * FROM holiday WHERE holiday_date = '$date_now'";
            $query = $conn->query($sql);
            $row2 = $query->fetch_assoc();

            if($query->num_rows > 0 ){
                $percent = $row2['percentage'];
                $doublepay = 4;
                $int = $doublepay*$percent;
            }
            echo "$int";
        ?>











      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>