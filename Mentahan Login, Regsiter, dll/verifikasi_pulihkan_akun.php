<?php 
session_start() ;
include('connect/connection.php');
?>

<?php 
    if(isset($_POST["verify"])){
        $email = $_SESSION['email'];
        $otp_code = $_POST['otp_code'];
        $otp = $_SESSION['otp'];

        if($otp != $otp_code){
            ?>
            <script>
                window.location.replace("./popup/pulihkan_akun_gagal.php");
            </script>
            <?php
        }else{
            mysqli_query($connect, "UPDATE login SET attempt = 0 WHERE email = '$email'");
            ?>
            <script>
                window.location.replace("./popup/pulihkan_akun_berhasil.php");
            </script>
            <?php
        }

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Verifikasi Pemulihan Akun</title>
    <link rel="stylesheet" href="./css/verifikasi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>
    <link rel="icon" href="../image/otp.png">
</head>

<body>
    <div class="box">
        <div class="form">
            <form action="#" method="POST">
                <h2>Mana kode verifikasi pemulihan akun lu?</h2>
                    <div class="inputBox">
                        <input type="text" id="otp" name="otp_code" required="required" autocomplete="off" autofocus>
                        <span>Kode Verifikasi</span>
                        <i></i>
                    </div>
                    <br>
                    <input type="submit" value="Verifikasi" name="verify">
                    <br>
                </form>
        </div>
    </div>
</body>