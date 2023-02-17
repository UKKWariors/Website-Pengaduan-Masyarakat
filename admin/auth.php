<?php

session_start();
$admin_login = $_SESSION["admin"];
// Jika Belum Login Redirect Ke Index
if(!isset($_SESSION["admin"])) header("Location: login");

?>
