<?php

use PHPMailer\PHPMailer\PHPMailer;

use Phalcon\Validation;

class Utilities extends \Phalcon\Mvc\Model
{

    public function initialize(){

    }

    public function sendEmail($to , $subject , $body)
    {

      
        $mailSuccess = true;
        $mail = new PHPMailer(true);
        try{

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username  = 'soportepruebas07@gmail.com';
            $mail->Password = 's0p0rt3sw';
            $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Port = 587; 
            $mail->setFrom('soportepruebas07@gmail.com', 'Soporte Cenpi');         
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();

        } catch (Exception $e){
            $mailSuccess = false;
            echo $e->getMessage();
        }
    }

    /**Get common error */

    public static function GetErrorMessage($entity)
    {
        $errorMessage = "";
        foreach ($entity->getMessages() as $message) {
            $errorMessage = $errorMessage . " " . $message;
        }
        return $errorMessage;
    }

    public static function GetDate($format = "Y-m-d H:i:s")
    {
        date_default_timezone_set('America/Bogota');
        return date($format);
    }

}

?>