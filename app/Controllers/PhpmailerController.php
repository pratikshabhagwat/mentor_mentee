<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class PhpmailerController extends BaseController
{
    // public function index()
    // {
        
    // }
    public function sendUserMail(){
        if($this->sendMail("suresh.s@kitintellect.com","Surya","subject","body")){
            echo "success";
        }else{
            echo "fake";
        };
    }
    public function sendMail($receiverMail,$receiverName,$subject,$body)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = getenv('SERVER_SMTP');                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   ="info@kitintellect.tech";                     //SMTP username
            $mail->Password   ="42@0Uvqf";                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom("info@kitintellect.tech","");
            $mail->addAddress($receiverMail, $receiverName);     //Add a recipient
        
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }


    // public function receiveMail(){
      
    //     $this->sendMail("pratiksha@kitintellect.com","pratiksha bhagwat","dummy mail","hkwdyuo o9wodwoo uuououoyucouo uouwou0p ");

    // }
}
