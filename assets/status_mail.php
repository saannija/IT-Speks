<?php
//https://github.com/PHPMailer/PHPMailer
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/PHPMailer.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);



try {
    //Server settings
    $mail->CharSet = "UTF-8";
    $mail->SMTPDebug = 0;                      //Enable verbose debug output 1 - SMTP kļūdas, 0 - neattēlotu
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'lvt.4pt@gmail.com';                     //SMTP username
    $mail->Password   = 'npdw kusw hump ooct';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    $appliction_data_string = $_SESSION['application_data']; //vacancy, email, status, status_changed, comments, send_mail
    $data = explode('|', $appliction_data_string);

    //Recipients
    $mail->setFrom('lvt.4pt@gmail.com', 'IT Spēks klientu serviss');
    $mail->addAddress($data[1]);     //Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML

    $subject = $body = null;

    if($data[3] == 0 && !empty($data[4])){
        $subject = "Jūsu pieteikumam tiek pievienoti komentāri!";
        $body = 'Pieteikuma vakance: <b>'. $data[0] .'</b>, statuss: <b>'. $data[2] .'</b>
        <br><br>Pievienotie komentāri: '.$data[4];

    }elseif($data[3] != 0 && !empty($data[4])){
        $subject = "Jūsu pieteikuma statuss ir mainīts!";
        $body = 'Pieteikuma statuss vakancei: <b>'. $data[0] .'</b> tika mainīts uz <b>'. $data[2] .'</b>
                <br><br>Pievienotie komentāri: '.$data[4];
    }else{
        $subject = "Jūsu pieteikuma statuss ir mainīts!";
        $body = 'Pieteikuma statuss vakancei: <b>'. $data[0] .'</b> tika mainīts uz <b>'. $data[2] .'</b>';
    }

    $mail->Subject = $subject;
    $mail->Body    = $body;

    if($data[5]){
        $mail->send();
    }


} catch (Exception $e) {
    echo "Ziņu nevar nosūtīt! Sistēmas kļūda: {$mail->ErrorInfo}";
}



?>