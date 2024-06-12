<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$smtpUsername = "avikonformularz@o2.pl"; // adres e-mail adresata
$smtpPassword = getenv("O2PASS"); // hasło do maila adresata
$emailFrom = "avikonformularz@o2.pl"; // adres e-mail adresata
$emailFromName = "avikonformularz@o2.pl"; // nazwa adresata
$emailTo = "natanek291@gmail.com"; // adres e-mail odbiorcy
$emailToName = "natanek291@gmail.com"; // imię adresata

$mail = new PHPMailer;
$mail->isSMTP();
$mail->CharSet = "UTF-8";
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "poczta.o2.pl"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 465; // TLS only
$mail->SMTPSecure = 'ssl'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = $smtpUsername;
$mail->Password = $smtpPassword;
$mail->setFrom($emailFrom, $emailFromName);
$mail->addAddress($emailTo, $emailToName);
$mail->Subject = $_POST["topic"];
$mail->msgHTML("E-mail: " . $_POST["email"] . "<br>Temat: " . $_POST["topic"] . "<br><br>Wiadomość: " . $_POST["message"]); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = "E-mail: " . $_POST["email"] . "\nTemat: " . $_POST["topic"] . "\n \nWiadomość: " . $_POST["message"];

if (!$mail->send()) {
    header("Location: messageSentError.html");
} else {
    header("Location: messageSentCorrectly.html");
}

die();
