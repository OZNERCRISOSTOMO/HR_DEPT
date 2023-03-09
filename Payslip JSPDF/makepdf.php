<?php

require_once __DIR__ . '/vendor/autoload.php';

$fname = $_POST['fname'];
$position = $_POST['position'];
$branch = $_POST['branch'];
$email = $_POST['email'];
$date = $_POST['date-from'];
$date1 = $_POST['date-to'];
$present = $_POST['present'];
$salary = $_POST['salary'];

$mdpf = new Mpdf\Mpdf();

$data = '';

$data = file_get_contents("content.php");
$data .= '<h1 style="text-align: center; font-family: Century Gothic;">Amity Company Inc.</h1>';
$data .= '<h3 style="text-align: center; font-family: Century Gothic;">Generated Payslip</h3>';

$data .= '<strong style="margin left: 15%;">Full Name: </strong>' . $fname . ' ';
$data .= '<strong>Position: </strong>' . $position . 'br /';
$data .= '<strong>Branch: </strong>' . $branch . '<br />';
$data .= '<strong>Email: </strong>' . $email . '<br />';
$data .= '<strong>From Date: </strong>' . $date . '<br />';
$data .= '<strong>To Date: </strong>' . $date1 . '<br />';
$data .= '<strong>Number of Present: </strong>' . $present . '<br />';
$data .= '<strong>Salary: </strong>' . $salary . '<br />';


$mdpf->WriteHTML($data);

$mdpf->Output($lname . '_' . $date . ' - payslip.pdf', 'D');