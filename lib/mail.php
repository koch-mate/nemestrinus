<?php
class Template {
        static function escReg($val) {
                return '/<!' . $val . '!>/';
        }

        function render($values, $string) {
                return preg_replace(array_map(array('Template', 'escReg'), array_keys($values)), array_values($values), $string);
        }
}

function sendEmail($to="koch.mate@gmail.com", $toName="Koch Máté", $subj="PHPMailer mail() test", $template="password", $d=[]){
  require 'vendor/phpmailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;
  $mail->setFrom(MAIL_FROM, MAIL_NAME);
  // DEBUG only FIXME!
  $to = 'koch.mate@gmail.com';
  
  $mail->addAddress($to, $toName);

  $mail->Subject = $subj;

  $msg = file_get_contents('../mails/'.$template.'.html');
  $T = new Template();
  $msg = $T->render($d, $msg);

  $mail->msgHTML($msg, '../mails/');
  $mail->AltBody = strip_tags($msg);

  //$mail->addAttachment('../vendor/phpmailer/examples/images/phpmailer_mini.png');

  if (!$mail->send()) {
      return False;
      // $mail->ErrorInfo;
  } else {
      return True;
  }
}




?>
