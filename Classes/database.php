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

    public function connect()
    {
        $connect = new PDO("mysql:host=$this->dbServername;dbname=u839345553_SBIT3G", $this->dbUsername, $this->dbPassword);

        // set the PDO error mode to exception
        $connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

        return $connect;    
    }

    public function sendEmail($recipient,$subject, $message, $attachment= 'default'){
       
        // create a new PHPMailer object
        $mail = new PHPMailer(true);

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'jason.yecyec023@gmail.com';
        $mail->Password = 'nbnxjownslkpgfqx';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //recipients
        $mail->setFrom('company@company.com','Company name');
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


}