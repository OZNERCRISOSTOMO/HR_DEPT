<!-- Modal Schedule -->
<?php $id = $_GET['id']; ?>
<form method="POST" action="../Functions/setSchedule.php">

      <div class="modal-body">
                              Schedule : 
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="1" id="1" name="schedule" required>
                                    <label class="form-check-label" for="1">7:00 AM - 3:00 PM</label>
                                </div>
            
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" value="2" id="2" name="schedule" required>
                                    <label class="form-check-label" for="2">3:00 PM - 11:00 PM</label>
                                </div>
                         
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value=<?php echo $id ?>>
        <button type="submit" name="submit1" class="btn btn-primary">Save changes</button>
      </div>

</form>