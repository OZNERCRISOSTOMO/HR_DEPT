
<!--Restore Modal-->
<div class="modal fade z-index-1" id="restoreModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure you want to restore this data?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
       mwehehe
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default text-danger border border-end-0 border-0" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-sm btn-success" onclick="location.href='../Functions/admin-payroll-restore.php?id=<?php echo $list['id']?>'" type="button">Restore</button>
      </div>
    </div>
  </div>
</div>