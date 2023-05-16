<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <title>Records of Applicant</title>
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-10">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-8 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-2">Job Registration</p>
                <?php
                if (isset($_GET["error"])) {
                    echo '<div class="container rounded shadow text-center p-2 text-danger mb-2" style="background-color: #ff9694;">';
                    if ($_GET["error"] == "alreadyExist") {
                        echo '<p class=""> Email already exist.</p>';
                    }else if ($_GET["error"] == "emptyInput") {
                        echo '<p class=""> Empty Input</p>';
                    }
                    echo '</div>';
                }
             
            ?> 
                <form class="mx-1 mx-md-6" action="../Functions/employee-register.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                  <div class="d-flex flex-row align-items-center mb-3 col-6">
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="first-name">Firstname:   </label>
                      <input type="text" id="first-name" name="first-name" class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3 col-6">
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="last-name">Lastname:</label>
                      <input type="text"id="last-name" name="last-name" class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3">
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="email">Email Address:</label>
                      <input type="email"id="email" name="email" class="form-control" />
  
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3 col-6">
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="contact-no">Contact No.:</label>
                      <input type="number" id="contact-no"  maxlength="11" name="contact-no" class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-3 col-6">
                   
                    <div class="form-outline flex-fill mb-0">
                    <label class="form-label" for="address">Address:</label>
                      <input type="text" id="address"   name="address" class="form-control" />
           
                    </div>
                  </div>


                  <div class="d-flex flex-row align-items-center mb-3 col-6">
                  <label class="form-label " for="form3Example3c">Gender:</label>
                  <div class="form-check form-check-inline mx-3">
                 
                    <input class="form-check-input" type="radio" id="male" name="gender" value="male">
                    <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline ">
                    <input class="form-check-input" type="radio" id="female" name="gender" value="female">
                    <label class="form-check-label" for="female">Female</label>
                    </div>
                 </div>


                 <div class="dropdown mb-3 col-6">
              
            <label for="department">Select depratment:</label>

            <select class="form-select" name="department" id="department">
                <option class="dropdown-item" value="">--Please choose an option--</option>
                <option class="dropdown-item" value="human-resource">Human Resource</option>
                <option class="dropdown-item" value="sales">Sales</option>
                <option class="dropdown-item" value="purchaser">Purchaser</option>
                <option class="dropdown-item" value="warehouse">Warehouse</option>                  
            </select>   
       
                    </div>  


                    <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Upload Resume</label>
                    <input type="file" class="form-control"
                   id="resume" name="resume"
                   accept="application/pdf" required>
                    </div>

                    <div class="input-group mb-3">
                    <label class="input-group-text" for="inputGroupFile01">Upload Picture</label>
                    <input type="file" class="form-control"
                   id="picture" name="picture"
                   accept="image/jpeg, image/png" required>
                    </div>



                   <div>
           

           
        </div>

                 
                    <button   name="submit"  class="btn btn-primary btn-lg">Register</button>
           
       
</div>


                </form>

          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>
</html>