
 <!-- Button trigger modal -->


<!-- Modal -->
<!-- Button trigger modal -->
<style>
  #exampleModal{
    z-index: -50;

  }
  </style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="static" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php 
        // Assume $start_date and $end_date are the two input dates in 'YYYY-MM-DD' format
$start = new DateTime('2023-02-01');
$end = new DateTime('2023-02-15');
$interval = new DateInterval('P1D'); // Interval of 1 day

// Loop through each date between the start and end dates
for ($date = $start; $date <= $end; $date->add($interval)) {
    $formatted_date = $date->format('Y-m-d');
    echo $formatted_date . "\n";
    // Do something with the date, such as query a database
}

        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>