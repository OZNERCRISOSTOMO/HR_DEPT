<?php
    spl_autoload_register('classAutoloader');

    function classAutoloader($className){
        $path = "../../Model/";
        // $extension = "-class.php";
        $fullPath = $path . $className;

        include_once $fullPath;
    }