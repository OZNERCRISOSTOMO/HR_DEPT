<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../Vendor/phpmailer/src/PHPMailer.php';
require '../Vendor/phpmailer/src/Exception.php';
require '../Vendor/phpmailer/src/SMTP.php';

// define('CACHE_KEY', 'my_cache_key');

class Database
{
    private $dbServername = "sql985.main-hosting.eu";
    private $dbUsername = "u839345553_sbit3g";
    private $dbPassword = "sbit3gQCU";
    private $connection;

     public function __construct( ) {
         $this->connection = new PDO("mysql:host=$this->dbServername;dbname=u839345553_SBIT3G", $this->dbUsername, $this->dbPassword);

        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }


     public function getConnection() {
        return $this->connection;
    }

    public function sendEmail($recipient,$subject, $message, $attachment= 'default'){
       
        // create a new PHPMailer object
        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '3gclothingline.noreply@gmail.com';
        $mail->Password = 'aguqhplqhbhvejvr';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //recipients
        $mail->setFrom('3gclothingline.noreply@gmail.com','3gclothingline');
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if($attachment != 'default'){
            $mail->addAttachment($attachment['tmpName'],$attachment['name']);
        }

        //Send the email
        if (!$mail->send()) {
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        } 
    }

    public function sendEmailPayslip($recipient,$subject, $message, $attachment= 'default'){
       
        // create a new PHPMailer object
        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = '3gclothingline.noreply@gmail.com';
        $mail->Password = 'aguqhplqhbhvejvr';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //recipients
        $mail->setFrom('3gclothingline.noreply@gmail.com','3gclothingline');
        $mail->addAddress($recipient);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        if($attachment != 'default'){
             // If attachment is provided, add it to the email
             $attachmentPath = $attachment['path'];
             $attachmentName = $attachment['name'];
             $mail->addAttachment($attachmentPath, $attachmentName);
        }

        //Send the email
        if (!$mail->send()) {
            echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        } 
    }


}