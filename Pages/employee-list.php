<html>
<head>
    <Title> Employee List </Title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/308043b825.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    container-fluid{
        overflow: hidden;
    }
    #inCard {
        background-color: #f2f2f2;
    };
</style>
</head>
<body style="background-color: #f2f2f2; font-family: Bahnschrift;">
    <!--Time and Date-->
        <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
            <h5 style="font-weight:bolder;"> 
            <script>                   
            document.write(new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true, day: 'numeric', month: 'short', year: 'numeric' }).toUpperCase());
            </script>    
            </h5>  
        </div>
    <!------End----->

    <!-----Title----->
        <div class="container d-flex ms-5 mt-2">
            <h5 style="font-weight:bolder;">Employee List</h5>
        </div>
    <!-----End----->
    
    <!-----Filter and Search Employee ----->
    <div class="container ">
        <div class="row float-end">
                <div class="col-md row ms-2">
                    <div class="col-sm rounded dropdown text-center bg-white">
                        <button class="btn dropdown-toggle fw-bolder container-fluid" type="button" data-bs-toggle="dropdown" id="dropdown">By Department</button>
                        <ul class="dropdown-menu container-fluid">
                            <li class="dropdown-item">Human Resources</li>
                            <li class="dropdown-item">Sales</li>
                            <li class="dropdown-item">Warehouse</li>
                            <li class="dropdown-item">Purchasing</li>
                        </ul>
                    </div>
                    <div class="col-sm input-group">
                        <span class="input-group-text bg-white border border-end-0 border-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" class="form-control border-0 border shadow-none border-start-0" id="Search" autocomplete="off">
                    </div>
                </div>
        </div>
    </div>
    <!-----End----->

    <!-----Employee List----->
    <div class="container mt-5">
    <div class="row-cols-4">
    <div class="card cols-1 bg-white rounded mx-2 py-3">
                        <img class="rounded-circle mx-auto" src="../img/Shipoo.jpg" height="100" width="100" alt="Employee Pic">    
                        <div class="card-body ps-1">
                            <h4 class="card-title text-center" name="EmployeeName">Shipoo Banini</h4>
                            <p class="card-text text-center" style="opacity: 0.5;">Project Manager</p>
                            <div id="inCard" class="rounded ms-3">
                            <table class="table table-borderless mt-2">
                                <thead>
                                    <tr class="text-center">
                                        <th>Department</th>
                                        <th>Date Hired</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    <tr class="text-center">
                                        <td name="Department">Sales</td>
                                        <td name="DateHired">02/02/2019</td>
                                    </tr>                     
                                </tbody>
                            </table>
                            
                            <p class="card-text ms-3" name="Email"><i class="fa-solid fa-envelope text-primary"></i> shipoobanini@gmail.com</p>
                            <p class="card-text ms-3" name="ContactNum"><i class="fa-solid fa-phone text-success"></i> 09123456789</p>
                                    <div class="float-end align-middle">
                                    <button type="button" class="btn" data-bs-toggle="modal" id="view" data-bs-target="#viewmodal">
                                        <i class="fa-solid fa-up-right-and-down-left-from-center text-secondary mx-0"></i>
                                    </button>
                                    <button type="button" class="btn" data-bs-toggle="modal" id="edit" data-bs-target="#editmodal">
                                        <i class="fa-solid fa-pen-to-square text-primary"></i>
                                    </button>
                                    <button type="button" class="btn" id="delete">
                                        <i class="fa-solid fa-square-minus text-danger"></i>
                                    </button>
                                    </div>
                        </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-----End----->

        <!-- Modal for View -->
        <div class="modal fade" id="viewmodal">
        <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">View</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-floating">
            <input type="text" class="form-control" name="EmployeeName" id="floatingName" placeholder="Employee Name"> </textarea>
            <label for="floatingName" style="font-family: Bahnschrift;">Employee Name</label>
            </div>

        <div class="form-floating mt-3">
            <textarea class="form-control" name="EmployeePos" id="floatingPosition" placeholder="Employee Position"> </textarea>
            <label for="floatingPosition" style="font-family: Bahnschrift;">Employee Position</label>
            </div>

        <div class="dropdown mt-3">
            <select name="Category" id="category">
            <option value="Category">Department</option>
            <option value="Sales">Sales</option>
            <option value="HR">HR</option>
            <option value="Secret">Secret</option>
            </select>
        </div>
        </div>
        <!--Modal Body End-->

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" name="add-details">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-----End----->

    <!-- Modal for Edit -->
        <div class="modal fade" id="editmodal">
        <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h5 class="modal-title">Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="form-floating">
            <input type="text" class="form-control" name="EmployeeName" id="floatingName" placeholder="Employee Name"> </textarea>
            <label for="floatingName" style="font-family: Bahnschrift;">Employee Name</label>
            </div>

        <div class="form-floating mt-3">
            <textarea class="form-control" name="EmployeePos" id="floatingPosition" placeholder="Employee Position"> </textarea>
            <label for="floatingPosition" style="font-family: Bahnschrift;">Employee Position</label>
            </div>

        <div class="dropdown mt-3">
            <select name="Category" id="category">
            <option value="Category">Department</option>
            <option value="Sales">Sales</option>
            <option value="HR">HR</option>
            <option value="Secret">Secret</option>
            </select>
        </div>
        </div>
        <!--Modal Body End-->

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" name="add-details">Submit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <!-----End----->

</body>
</html>