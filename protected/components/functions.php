<?php
function mailer_mail($to,$subject,$body,$from=null,$fromName=null,$additional_headers=null)
{
    require_once(Yii::getPathOfAlias('webroot').'/PHPMailer/class.phpmailer.php');
    $mail             = new PHPMailer();
    $body             = $body;

    $mail->IsSMTP(); // telling the class to use SMTP
    //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                               // 1 = errors and messages
                                               // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    if(Yii::app()->params['smtp_secure'])
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = Yii::app()->params['smtp_host']; // sets the SMTP server
    $mail->Port       = Yii::app()->params['smtp_port'];                    // set the SMTP port for the GMAIL server
    $mail->Username   = Yii::app()->params['smtp_user']; // SMTP account username
    $mail->Password   = Yii::app()->params['smtp_password'];        // SMTP account password
    if(!$from)
        $from=Yii::app()->params['adminEmail'];
    $fromName=$from;
    if(!$fromName)
        $fromName='MusicDream Admin';
    $mail->SetFrom ($from, $fromName);
    $mail->AddReplyTo($from,$fromName);

    $mail->MsgHTML($body);

    $mail->Subject    =$subject;

    $address = $to;
    $mail->AddAddress($address, $address);

    return $mail->Send();
}