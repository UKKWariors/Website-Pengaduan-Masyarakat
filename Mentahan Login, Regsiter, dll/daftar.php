<?php session_start(); ?>
<?php
    include('connect/connection.php');

    if(isset($_POST["register"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];

        $check_query = mysqli_query($connect, "SELECT * FROM login where email ='$email' OR name ='$name'");
        $rowCount = mysqli_num_rows($check_query);

        if(!empty($name) && !empty($email) && !empty($password) && !empty($cpassword)){
            if($password !== $cpassword){
                ?>
                <script>
                    window.location.replace('./popup/daftar_pts.php');
                </script>
                <?php
            }
            if($rowCount > 0){
                ?>
                <script>
                    window.location.replace('./popup/daftar_esa.php');
                </script>
                <?php
            }else{
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                $result = mysqli_query($connect, "INSERT INTO login (name, email, password, status, attempt) VALUES ('$name', '$email', '$password_hash', 0, 0)");
    
                if($result){
                    $otp = rand(100000,999999);
                    $_SESSION['otp'] = $otp;
                    $_SESSION['mail'] = $email;
                    require "Mail/phpmailer/PHPMailerAutoload.php";
                    $mail = new PHPMailer;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='sekolahkarijeneng@gmail.com';
                    $mail->Password='cphnjcbygasymxiy';
    
                    $mail->setFrom('sekolahkarijeneng@gmail.com', 'noreply@sekolahkarijeneng.com');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Kode Verifikasi Akun Anda";
                    $mail->Body="<p>Dear $name, </p>
                    <h3>Kode verifikasi akun anda adalah $otp <br></h3>
                    <br><br>
                    <p>Hormat kami</p>
                    <b>Sekolah Kari Jeneng</b>";
    
                    if(!$mail->send()){
                        ?>
                            <script>
                                window.location.replace('./popup/daftar_etv.php');
                            </script>
                        <?php
                    }else{
                        ?>
                        <script>
                            window.location.replace('verifikasi_daftar.php');
                        </script>
                        <?php
                    }
                }
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Halaman Daftar</title>
    <link rel="stylesheet" href="./css/daftar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>
    <link rel="icon" href="../image/register.png">
</head>

<body>
    <div class="box">
        <div class="form">
            <form action="#" method="POST" onsubmit="return verifyPassword()">
                <h2>Cie Yg Mau Daftar</h2>
                    <div class="inputBox">
                        <input type="name" id="name"  name="name" required="required" autocomplete="off">
                        <span>Username</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="text" id="email_address" name="email" required="required" autocomplete="off">
                        <span>Email</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password"  name="password" required="required" autocomplete="off">
                        <span>Password</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="cpassword"  name="cpassword" required="required" autocomplete="off">
                        <span>Confirm Password</span>
                        <i></i>
                    </div>
                    <br>
                        <input type="submit" value="Daftar" name="register">
                        <br>
                        <br>
                    <div class="links">
                        <p>Sudah mempunyai akun? </p>
                        <br>  
                        <a align="center" href="masuk.php">Masuk disini</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>