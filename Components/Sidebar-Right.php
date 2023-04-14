
<div class="container-fluid align-content-end order-last ">
  <div class="row flex-nowrap">
    <div class="col-md-4  col-xl-2 px-sm-2 px-0 bg-white order-last vh-100 position-fixed shadow">
      <div class="d-flex me-2 flex-column align-items-center px-1  text-white min-vh-100 position-fixed">
                
            
      <form action="../Functions/admin-sendEmail.php" method="POST" enctype="multipart/form-data">
      <div class="search-select-box mb-2 mt-3 ">                     
                        <!-- Dropdown --> 
                        <select id='select-employee' name="employee-id" class="form-control">
                            <option value="0">Select employee</option>
                         <?php
                             $employees = $admin->getEmployees();

                             foreach($employees as $employee){
                                echo "<option value='".$employee['id'] ."'>". $employee['first_name']." ".$employee['last_name']  ."</option> ";
                             }
                         ?>
                        </select>

                    </div>
            <div class="mb-2 input-group input-group-sm">  
                        <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                    </div>
                    <div class="mb-2 input-group input-group-sm">
                        <textarea class="form-control" name="message"  rows="4" placeholder="Message" required></textarea>
                    </div>
                    <div class="mb-2 input-group input-group-sm">
                     <input class="col-2 form-control" type="file" id="attachment" name="attachment" accept="application/pdf">
                            </div>
                    <input type="hidden" id="" name="">
                    <div class="d-grid gap-2 ">
                    <button  class=" btn btn-primary btn-sm" name="submit" id="send-email"><i class="fa-solid fa-paper-plane me-2"></i> Send</button>
                            </div>  
            </form>


      
            </div>
        </div>

       
    </div>
</div>
