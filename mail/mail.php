<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
    $_POST = json_decode(file_get_contents('php://input'), true);

$name= trim($_POST['name']);
$phone = trim($_POST['phone']);
$address = trim($_POST['address']);

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$email = new PHPMailer(TRUE);
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.yandex.ru';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication

    $mail->Username = 'username'; // SMTP username
    $mail->Password = 'password'; // SMTP password

    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //$subject = utf8_decode('Вызов замерщика');
    //$subject = iconv('cp1252', 'utf-8' 'Вызов замерщика');
    //$subject = base64_encode('Вызов замерщика');

    //Recipients
    $mail->setFrom('vsepotolok@yandex.ru', 'VSEPOTOLOK');  // < ---- ???????

    //$mail->addAddress('al.nkow@gmail.com', 'Administrator');
    $mail->addAddress('rafas@mail.ru', 'Administrator');     // Add a recipient
    $mail->addAddress('garantkamsk@mail.ru', 'Administrator');     // Add a recipient

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'ВСЕПОТОЛОК.РФ: Вызов замерщика с сайта';

    $mail->Body    = '<p>Пользователь: <b>'.$name.'</b></p><p>Номер телефона: <b>'.$phone.'</b></p><p>Адрес: <b>'.$address.'</b></p>';
    $mail->AltBody = 'Пользователь: '.$name.' Номер телефона: '.$phone.' Адрес: '.$address;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>