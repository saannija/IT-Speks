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

if(isset($_POST["sendMsg"])){

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

    //Recipients
    $mail->setFrom('affl1c73d@gmail.com', 'IT Spēks klientu serviss');
    $mail->addAddress('affl1c73d@gmail.com', 'IT Spēks klientu serviss');     //Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Sazinieties ar mums, Ziņa no ' . $_POST['name'];
    $mail->Body    = 'Ziņas sūtītājs: <b>'.$_POST["name"].'</b><br>
                      Ziņas sūtītāja e-pasts: <b>'.$_POST["email"].'</b><br>
                      Ziņas sūtītāja tālrunis: <b>'.$_POST["phone"].'</b><br>
                      Ziņojums: <b>'.$_POST["message"].'</b><br>';

    if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["message"])){
        $mail->send();
        echo "<div class='notif green'><i class='fa-solid fa-circle-exclamation'></i>Paldies, ka sazinājāties ar mums! Mēs atbildēsim uz jūsu ziņu pēc iespējas ātrāk.</div>";
    }else{
        echo "<div class='notif red'><i class='fa-solid fa-circle-exclamation'></i>Jūsu ziņojuma nosūtīšanā ir pieļauta kļūda. Lūdzu, mēģiniet vēlreiz.</div>";
    }

    echo "<script>
    setTimeout(function() {
        window.location.reload();
    }, 5000);
    </script>";  

} catch (Exception $e) {
    echo "Ziņu nevar nosūtīt! Sistēmas kļūda: {$mail->ErrorInfo}";
}

}

?>