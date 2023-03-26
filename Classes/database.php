<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../Vendor/phpmailer/src/PHPMailer.php';
require '../Vendor/phpmailer/src/Exception.php';
require '../Vendor/phpmailer/src/SMTP.php';


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

    public function uploadFileToHostinger($fileTmpName,$fileName){
        // FTP login details
        $ftp_server = "217.21.73.231";
        $ftp_username = "u839345553";
        $ftp_password = "SBIT3G_qcu";

        // Local file to upload
        $local_file = $fileTmpName;

        // Remote file name
        $remote_file = "/public_html/uploads/" . $fileName;

        // Connect to FTP server
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");

        // Login to FTP server
        ftp_login($ftp_conn, $ftp_username, $ftp_password) or die("Could not login to FTP server");

        // Upload file to FTP server
        if (ftp_put($ftp_conn, $remote_file, $local_file, FTP_BINARY)) {
            // echo "File uploaded successfully";
            // Close FTP connection
            ftp_close($ftp_conn);
            return true;
        } else {
            // echo "Error uploading file";
                  // Close FTP connection
            ftp_close($ftp_conn);
            return false;
        }

  
    }

    public function fetchFileFromHostinger(){
       // Turn off error reporting
    error_reporting(0);

        // FTP login details
        $ftp_server = "217.21.73.231";
        $ftp_username = "u839345553";
        $ftp_password = "SBIT3G_qcu";

        // Local directory to save files to
        $local_directory = "C:/xampp/htdocs/HR_DEPT/Uploads";

        // Connect to FTP server
        $ftp_conn = ftp_connect($ftp_server) or die("Could not connect to FTP server");

        // Login to FTP server
        ftp_login($ftp_conn, $ftp_username, $ftp_password) or die("Could not login to FTP server");

        // Switch to passive mode
        ftp_pasv($ftp_conn, true);

// Enable debugging mode
// ftp_set_option($ftp_conn, FTP_DEBUG_INFO, true);

// Set the directory to download files from
$directory = "/public_html/uploads";

// Get the list of files in the directory
if ($file_list = ftp_nlist($ftp_conn, $directory)) {
    // Download each file to the local directory
    foreach ($file_list as $file) {
        $local_file = $local_directory . "/" . basename($file);
          ftp_get($ftp_conn, $local_file, $file);
    }
} else {
    echo "Error retrieving file list from remote server\n";
}

// Close FTP connection
ftp_close($ftp_conn);
// Turn on error reporting
error_reporting(E_ALL);
    }
}