<?php
function Send_Mail($to,$subject,$body)
{
require_once ('class.phpmailer.php');
$mail = new PHPMailer();
$mail->SMTPDebug = 1;
$mail -> IsSMTP();
$mail -> SMTPAuth = true;
$mail -> SMTPSecure = "tls";
$mail -> Host = "email-smtp.eu-west-1.amazonaws.com";
$mail -> Port = 587;  // SMTP Port
$mail -> Username = "AKIAJIN4MKQLL6BRRNPQ";
$mail -> Password = "AjIHhkTEBr3SXOqnp+3+AML6PjKQyHx95B7nenwjhdYc";  // SMTP Password
$myfrom = "mark.mckee@publishforce.com"; //"mark_a_mckee@hotmail.com";
$mail -> SetFrom("$myfrom", ''); //$user_email;
$mail -> Subject = $subject;
$mail -> MsgHTML($body);
$mail -> AddAddress("$to", "");
//print "about to send to $to with subject $subject and text $body , from $myfrom <br>";
if ($mail -> Send()) {
    return 1;
} else {
    echo "<br> Mail not sent, try again!";
    return 0;
}

}
?>