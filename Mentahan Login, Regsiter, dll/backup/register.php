<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'

if (isset($_POST["register"]))
{
    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;

        $mail->isSMTP();
        $mail->Host ='smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $Mail->setFrom('myemail','Sekolah Kari Jeneng');
        $mail->addAddress($email, $username);
        $mail->isHTML(true);
        $verification_code = substr(number_format(time() = rand(),0, '', ''), 0, 6);
        $mail->Subject = 'Kode Verifikasi'
        $mail->Body = 'Kode verifikasi anda untuk akun $username adalah' <b style="font-size: 30px;"> . $verification_code.' </b>
    }
}

<form method="post">
    <input type="text" name="name" placeholder="Masukkan Username">
    <input type="email" name="email" placeholder="Masukkan Email">
    <input type="password" name="password" placehoolder="Masukkan Password">
    <input type=" password" name="re_password" placeholder="Masukkan Password Kembali">

    <button type="submit" name="register">Daftar</button>
</form>