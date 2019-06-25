<?php 

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require_once $_SERVER['DOCUMENT_ROOT']."/bukutamu_php/vendor/autoload.php";
function send_mail($subject, $body, $address_to, $address_name)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'aqua.noreply.bukutamu@gmail.com';   //username
    $mail->Password = 'adminadminadmin';   //password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;                    //SMTP port
    $mail->setFrom('aqua.noreply.bukutamu@gmail.com', 'Sistem pelaporan Aqua');
    $mail->addAddress($address_to, $address_name);
     
    $mail->isHTML(true);
     
    $mail->Subject = $subject;
    $mail->Body    = $body;
     
    $mail->send();
    // echo 'Message has been sent';    
}

?>
