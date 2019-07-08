<?php

namespace App\Core\Utilities;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mailer{
    private $mail;


    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->mail->setLanguage("pt");
    }
    
    public function send(){
        try {
            //Server settings
            $mail = $this->mail;
            $mail->SMTPDebug = 2;                                       // Enable verbose debug output
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'gnberthier@gmail.com';                     // SMTP username
            $mail->Password   = '@@gingerbread77';                               // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom('gnberthier@gmail.com');
            $mail->addAddress('gabriel.berthier@acad.ifma.edu.br', 'Gabriel');     // Add a recipient
            
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}



