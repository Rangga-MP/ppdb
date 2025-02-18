<?php
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/autoload.php';

function sendVerificationEmail($email, $token) {
    $mail = new PHPMailer();
    try {
        // Konfigurasi SMTP                   //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'wrath0003@gmail.com';                     //SMTP username
        $mail->Password   = 'bmmgzrgfdboyzcvp';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587 ;

        // Pengaturan email
        $mail->setFrom('wrath0003@gmail.com', 'PPDB System'); // Ganti dengan email pengirim
        $mail->addAddress($email); // Email penerima
        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Akun Anda';
        $mail->Body = "Klik tautan berikut untuk memverifikasi akun Anda: 
                       <a href='http://localhost/ppdb/verify.php?token=$token'>Silahkan Verifikasi Email</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
