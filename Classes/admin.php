<?php

class Admin {

    private $database;

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function findByEmail($email) {
        // prepare the SQL statement using the database property
        $stmt = $this->database->connect()->prepare("SELECT * FROM hr_dept WHERE email=?");

         //if execution fail
        if (!$stmt->execute([$email])) {
            header("Location: ../index.php?error=stmtfail");
            exit();
        }

        //fetch the result
        $result = $stmt->fetch();
        
          //if has result return it, else return false
        if ($result) {
            return $result;
        } else {
            $result = false;
            return $result;
        }

        //close connection
        unset($this->database);
    }

}