<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'public/mail/vendor/autoload.php';

class SMTPMailer {
    public static function sendMail($to, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
           
            $mail->isSMTP();   
            $mail->Host = 'smtp.gmail.com';   
            $mail->SMTPAuth = true;   
            $mail->Username = 'your email';  
            $mail->Password = 'your app password';  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            $mail->Port = 587;  
            $mail->setFrom('your email', 'Enjoy Blog RESET PASSWORD');   
            $mail->addAddress($to);  
            $mail->isHTML(true);  
            $mail->Subject = $subject;  
            $mail->Body = $body;   
            return $mail->send(); 
        } catch (Exception $e) {
            return false;
        }
    }
}
?>
