<?php
    include('connect/connection.php');

    if(isset($_POST["login"])){
        $email = $_POST['email'];
        $password = trim($_POST['password']);

        $sql = mysqli_query($connect, "SELECT * FROM login where email = '$email' OR name = '$email'");
        $count = mysqli_num_rows($sql);

            if($count > 0){
                $fetch = mysqli_fetch_assoc($sql);
                $hashpassword = $fetch["password"];
    
                if($fetch["attempt"] < 3){
                    
                    if($fetch["status"] == 0){
                        ?>
                        <script>
                        window.location.replace('./popup/login_sva.php');
                        </script>
                        <?php
                    }else if(password_verify($password, $hashpassword)){
                        ?>
                        <script>
                            window.location.replace('./popup/login_berhasil.php');
                        </script>
                        <?php
                        mysqli_query($connect, "UPDATE login SET attempt = 0 WHERE email = '$email' OR name = '$email'");
                        ?>
                        <?php
                    }else{
                        ?>
                        <script>
                            window.location.replace('./popup/login_eps.php');
                        </script>
                        <?php
                        mysqli_query($connect, "UPDATE login SET attempt = attempt + 1 WHERE email = '$email' OR name = '$email'");
                        ?>
                        <?php
                    }
                }else{
                    {
                    ?>
                    <script>
                        window.location.replace('./popup/login_atb.php');
                    </script>
                    <?php
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
    <title>Halaman Login</title>
    <link rel="stylesheet" href="./css/masuk.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/main.js"></script>
    <link rel="icon" href="../image/login.png">
</head>

<body>
    <div class="box">
        <div class="form">
            <form action="#" method="POST">
                <h2>Masuk bosque</h2>
                    <div class="inputBox">
                        <input type="text" id="email_address" name="email" required="required" autocomplete="off">
                        <span>Email / Username</span>
                        <i></i>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password"  name="password" required="required" autocomplete="off">
                        <span>Password</span>
                        <i></i>
                    </div>
                    <br>
                    <div class="links">
                        <a href="lupa_password.php">Lupa password ya?</a>
                    </div>
                    <input type="submit" value="Masuk" name="login">
                    <br>
                    <br>
                    <div class="cr">
                        <p align="center" color="#28292d">Tidak mempunyai akun? </p>
                        <br>
                        <a align="center" href="daftar.php">Daftar disini</a>
                    </div>
            </form>
        </div>
    </div>
</body>
</html>