<?php
/* == PHPemailer: emailer('$from_email','$from_name','$to_email','$subject','$body','$body_alt'); == */
function emailer($from,$from_name,$email,$subject,$body,$body_alt,$attachment){
 require 'PHPMailerAutoload.php';
 $mail = new PHPMailer(); // load phpemailer
 $mail->IsSMTP();
 $mail->Host = "mail.insurancenations.com";
 // optional
 // used only when SMTP requires authentication  
 $mail->SMTPAuth = true;
 $mail->Username = 'services@insurancenations.com';
 $mail->Password = '88878iKxh&';
 $mail->From = $from; // from variable
 $mail->FromName = $from_name; // from name variable
 $mail->addAddress($email); // send to email, name variable
 //$mail->addBCC('', ''); // send to email, name bbc variable
 $mail->Subject= $subject; // subject variable
 $mail->isHTML(true); // if the body is HTML
 $mail->Body= $body; // body variable
 $mail->AltBody = $body_alt; // body alternative variable
 $mail->addAttachment(''.$attachment.'');         // Add attachments
 if(!$mail->send()){ // if send email error
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
 } 
 else { // else sent successfully
 //echo 'Message has been sent';
 }
}
?>