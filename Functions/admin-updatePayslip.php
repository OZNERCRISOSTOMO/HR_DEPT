<?php
require '../Classes/admin.php';
require '../Classes/database.php';

$database = new Database();
$admin = new Admin($database);


if(isset($_POST["submit-edit"])){
     echo "edit";
}