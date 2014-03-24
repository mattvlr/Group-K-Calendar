<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = "groupkscheduler@gmail.com";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host       = "tls://smtp.gmail.com"; // Amazon SES server, note "tls://" protocol
$mail->Port       = 465;                    // set the SMTP port
$mail->Username   = "groupkscheduler@gmail.com";  // SES SMTP  username
$mail->Password   = "groupk123";  // SES SMTP password
$mail->SetFrom($from, 'groupkscheduler');
$mail->AddReplyTo($from,'groupkscheduler');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);

if(!$mail->Send())
return false;
else
return true;

}
?>