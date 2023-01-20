<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <div class="box">
        <div class="form">
            <h2>Masuk bosque</h2>
            <div class="inputBox">
                <input type="text" required="required" autocomplete="off">
                <span>Email</span>
                <i></i>
            </div>
            <div class="inputBox">
                <input type="password" required="required" autocomplete="off">
                <span>Password</span>
                <i></i>
            </div>
            <div class="links">
                <a href="recover_psw.php">Lupa password ya?</a>
            </div>
            <input type="submit" value="Masuk">
            <br>
            <div class="cr">
                <p align="center" color="#28292d">Tidak mempunyai akun? </p>
                <br>  
                <a align="center" href="register.php">Daftar disini</a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',() => {
        var disclamer = document.querySelector("img[alt='www.000webhost.com']");
            if(disclamer){
                disclamer.remove();
            }
        });
    </script>
</body>