<?php
/**
 * This example shows sending a message using PHP's mail() function.
 */

require '../vendor/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->setFrom('no-reply@ihartu.hu', 'Ihartü Automated Mailer');
$mail->addAddress('koch.mate@gmail.com', 'Koch Máté');

$mail->Subject = 'PHPMailer mail() test';

$mail->msgHTML(file_get_contents('../vendor/phpmailer/examples/contents.html'), '../vendor/phpmailer/examples/');
$mail->AltBody = 'This is a plain-text message body';

$mail->addAttachment('../vendor/phpmailer/examples/images/phpmailer_mini.png');

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

?>
