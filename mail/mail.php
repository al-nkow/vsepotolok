<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'phpmailer/src/Exception.php';

/* The main PHPMailer class. */
require 'phpmailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'phpmailer/src/SMTP.php';

$email = new PHPMailer(TRUE);

//Load composer's autoloader
//require '/home/username/vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.yandex.ru';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication

    $mail->Username = 'vsepotolok@yandex.ru';                 // SMTP username
    $mail->Password = 'RHxA333QKpk';                           // SMTP password

    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('user@example.com', 'Mailer');
    $mail->addAddress('al.nkow@gmail.com', 'Aleksey Kovalchuk');     // Add a recipient
    //$mail->addAddress('contact@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Subject line goes here';
    $mail->Body    = 'Body text goes here';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

//<?php
//
//if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
//    $_POST = json_decode(file_get_contents('php://input'), true);
//
//$sender = trim($_POST[sender]);
//$mail = trim($_POST[mail]);
//$message = trim($_POST[message]);
//
//$body = '<p>Пользователь: <b>'.$sender.'</b> <i>('.$mail.')</i></p><p>Сообщение: '.$message.'</p>';
//$altBody = 'Пользователь: '.$sender.' ('.$mail.') Сообщение: '.$message;
//
//require 'phpmailer/PHPMailerAutoload.php';
//
//$mail = new PHPMailer;
//
//$mail->isSMTP();
//
//$mail->Host = 'smtp.timeweb.ru';
//$mail->Port = 465; // если tls - 25 или 2525 для timeweb
//$mail->SMTPSecure = 'ssl'; // можно также tls или STARTTLS для timeweb
//$mail->SMTPAuth = true;
//
//$mail->Username = "info@ak-me.ru";
//$mail->Password = "xTstWrJr8gFcE";
//
//$mail->setFrom('info@ak-me.ru', 'Системное сообщение'); // от кого
// кому (можно дублировать эту строку - несколько получателей):
//$mail->addAddress('al.nkow@gmail.com', 'Aleksey Kovalchuk');
//
//$mail->CharSet = 'UTF-8';
//$mail->isHTML(true);
//$mail->Subject = 'Новое сообщение с сайта AK-ME.RU';
//$mail->msgHTML($body); // тело письма
// если сервер не поддерживает письма в формате HTML - будет отправлено это:
//$mail->AltBody = $altBody;
//
//if (!$mail->send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
//} else {
//    echo "Message sent!";
//}
//
//?>



?>