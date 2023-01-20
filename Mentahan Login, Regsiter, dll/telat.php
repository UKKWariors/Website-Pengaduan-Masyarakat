<?php 
session_start() 
?>

<?php 
    if(isset($_POST["veriftelat"])){
        include('connect/connection.php');
        $email = $_POST["email"];

        $sql = mysqli_query($connect, "SELECT * FROM login WHERE email='$email'");
        $query = mysqli_num_rows($sql);
        $fetch = mysqli_fetch_assoc($sql);
        $name = $fetch["name"];

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                window.location.replace("./popup/password_gayk.php");
            </script>
            <?php
        }else if($fetch["status"] == 0){
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            //session_start ();
            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='sekolahkarijeneng@gmail.com';
            $mail->Password='cphnjcbygasymxiy';

            // send by h-hotel email
            $mail->setFrom('sekolahkarijeneng@gmail.com', 'noreply@sekolahkarijeneng.com');
            // get email from input
            $mail->addAddress($_POST["email"]);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Memverifikasi Akun Anda yang Terlambat";
            $mail->Body="<b>Dear $name</b>
            <h3>Kami menerima anda meminta untuk Memverifikasi Akun Anda yang Terlambat diverifikasi.</h3>
            <p>Silahkan masukkan Kode verifikasi berikut $otp</p>
            <br><br>
            <p>Hormat Kami</p>
            <b>Sekolah Kari Jeneng</b>";

            if(!$mail->send()){
                ?>
                    <script>
                        window.location.replace("./popup/password_etv.php");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        window.location.replace("verifikasi_telat.php");
                    </script>
                <?php
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Verifikasi Telat</title>
    <link rel="stylesheet" href="./css/lupa_password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>
    <link rel="icon" href="../image/forget.png">
</head>

<body>
    <div class="box">
        <div class="form">
            <form action="#" method="POST">
                <h2>Verifikasi kok telat</h2>
                    <div class="inputBox">
                        <input type="text" id="email_address" name="email" required="required" autocomplete="off">
                        <span>Email</span>
                        <i></i>
                    </div>
                    <br>
                    <input type="submit" value="Verifikasi" name="veriftelat">
                    <br>
                    <br>
                </form>
        </div>
    </div>
</body>