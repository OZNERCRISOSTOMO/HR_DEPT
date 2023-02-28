<?php
  session_start();
  session_unset($_SESSION["admin_id"]);
  session_destroy();

  //Go back to admin-login
  header("Location: ../index.php");