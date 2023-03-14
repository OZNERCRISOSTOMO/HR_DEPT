<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate PDF</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
    crossorigin="anonymous">"
</head>
<body>
    <div class="container mt-5">
        <form action="makepdf.php" method="post" class="offset-md-3 col-md-6">
            <h1>Generate Payslip</h1>
            <p>Fill out the form to generate payslip into PDF</p>

            <div class="row mb-2">
                <div class="col-md-6">
                    <input type="text" name="fname" placeholder="Firstname" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <input type="text" name="position" placeholder="Position" class="form-control" required>
                </div>

            </div>

            <div class="mb-2">
            <input type="text" name="branch" placeholder="Branch" class="form-control" required>
            </div>

            <div class="mb-2">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>

            <div class="mb-2">
            <p>From Date: </p>
            <input type="date" name="date-from" id="date-from" class="form-control" placeholder="From" required>
            </div>

            <div class="mb-2">
            <p>To Date: </p>
            <input type="date" name="date-to" id="date-to" class="form-control" placeholder="To" required>
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="number" name="present" id="present" placeholder="Number of Present" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <input type="number" name="overtime" placeholder="Number of Overtime (per hour)" class="form-control" required>
                </div>
            </div>
            
            <div class="mb-2">
            <input type="number" name="salary" id="salary" placeholder="Salary" class="form-control" required>
            </div>

            <div class="deductions">
                <p><b>Membership/Beneficiaries:</b></p>
                    <input type="checkbox" id="sss" name="sss" value="0.04">
                        <label for="beneficiaries1">SSS Beneficiaries</label><br>
                    <input type="checkbox" id="pagibig" name="pagibig" value="0.02">
                        <label for="beneficiaries2">Pag Ibig Beneficiaries</label><br>
                    <input type="checkbox" id="philhealth" name="philhealth" value="0.05">
                        <label for="beneficiaries3">Philhealth Beneficiaries</label><br /><br />
            </div>

                 <button type="submit" class="btn btn-success btn-lg btn block">Generate Payslip</button>
        </form>
    </div>
</body>
</html>