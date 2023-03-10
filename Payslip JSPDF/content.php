<?php
$fname = $_GET['fname'];
$position = $_GET['position'];
$branch = $_GET['branch'];
$email = $_GET['email'];
$date = $_GET['date-from'];
$date1 = $_GET['date-to'];
$present = $_GET['present'];
$salary = $_GET['salary'];
?>

<style type="text/css">
    table {
        width: 100%;
        background: #eee;
        padding: 10px;
        font-size: 13px;
        font-family: Arial;
        border-spacing: 0;
    }
    th {
        background-color: #ddd;
        padding: 4px;
        width: 100px;
    }
    td {
        padding: 4px;
        border-bottom: solid thin #ddd;
    }

</style>
<div style = "font-family: Century Gothic;">
        <center><h1>Company Name</h1></center>
        <center><h3>Generated Payslip</h3></center>

            <table>
                <th style= "text-align: center;">Payroll Details</th>
                    <tr>
                        <th>Full Name:</th>
                        <td><?=$fname?></td>

                        <th>Position:</th>
                        <td><?=$position?></td>
                    </tr>

                    <tr>
                        <th>Branch:</th>
                        <td><?=$branch?></td>

                        <th>Email Address:</th>
                        <td><?=$email?></td>
                    </tr>

                    <tr>
                        <th>From Date:</th>
                        <td><?=$date?></td>

                        <th>To Date:</th>
                        <td><?=$date1?></td>
                    </tr>

                    <tr>
                        <th>Number of Present:</th>
                        <td><?=$present?></td>

                        <th>Total Salary:</th>
                        <td><?=$salary?></td>
                    </tr>
            </table>
</div>