<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Register</title>
</head>
<body>
    <h1>Employee Register</h1>
    <form action="../Functions/employee-register.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="first-name">First name</label>
            <input type="text" id="first-name" name="first-name">
        </div>

        <div>
            <label for="last-name">Last name</label>
            <input type="text" id="last-name" name="last-name">
        </div>
      
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
   
        <div>
            <label for="contact-no">Contact number</label>
            <input type="text" id="contact-no"  maxlength="11" name="contact-no">
        </div>
            <label for="address">Address</label>
            <input type="text" id="address"  maxlength="11" name="address">
        <div>

        </div>

        <div>
            Gender: 
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>

            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
        </div>

        <div>
            <label for="department">Select depratment:</label>

            <select name="department" id="department">
                <option value="">--Please choose an option--</option>
                <option value="sales">Sales</option>
                <option value="inventory">Inventory</option>          
            </select>   
        </div>

        <div>
            <label for="resume">Upload Resume:</label>

            <input type="file"
                   id="resume" name="resume"
                   accept="application/pdf">
        </div>

        <button  name="submit">Submit</button>
    </form>
</body>
</html>