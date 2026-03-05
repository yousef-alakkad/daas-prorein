<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.yourdomain.com';
        $mail->SMTPAuth    = true;
        $mail->Username    = 'info@daas-prorein.com';
        $mail->Password    = 'YOUR_EMAIL_PASSWORD';
        $mail->SMTPSecure   = 'ssl';
        $mail->Port         = 465;

        $mail->setFrom('info@daas-prorein.com', 'Kontakt');
        $mail->addAddress('info@daas-prorein.com');

        $mail->Subject = 'Neue Kontaktanfrage: ' . $subject;
        $mail->Body    = "
        Name: $name
        Email: $email
        Telefon: $phone

        Nachricht:
        $message
        ";

        $mail->send();
        echo "Nachricht erfolgreich gesendet";

    } catch (Exception $e) {
        echo "Fehler: {$mail->ErrorInfo}";
    }
}
?>
